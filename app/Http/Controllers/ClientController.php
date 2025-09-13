<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;
use Illuminate\Support\Str;

class ClientController extends Controller
{
    public function index()
    {
        $clients = Client::orderBy('company_name')->get();
        $clientCount = Client::count();

        // provide `$certs` for the existing blade
        return view('dashboard.client-certifications', [
            'certs'        => $clients,
            'clientCount'  => $clientCount,
        ]);
    }

    public function assessments()
    {
        $clients = Client::orderBy('company_name')->get();
        return view('dashboard.client-assessments', compact('clients'));
    }

    public function updateAssessment(Request $request, Client $client)
    {
        $data = $request->validate([
            'auditor_code'        => ['nullable', 'string', 'max:100'],
            'auditor_name'        => ['nullable', 'string', 'max:255'],
            'assigned_standard'   => ['nullable', 'string', 'max:255'],

            'report_file'               => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'company_profile_file'      => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'ssm_file'                  => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'sop_file'                  => ['nullable', 'file', 'mimes:pdf', 'max:10240'],

            'licenses_files'            => ['nullable', 'array'],
            'licenses_files.*'          => ['file', 'mimes:pdf', 'max:10240'],
            'forms_evidence_files'      => ['nullable', 'array'],
            'forms_evidence_files.*'    => ['file', 'mimes:pdf', 'max:10240'],
            'iso_files'                 => ['nullable', 'array'],
            'iso_files.*'               => ['file', 'mimes:pdf', 'max:10240'],

            // NEW: what to remove
            'remove_licenses'           => ['nullable', 'array'],
            'remove_licenses.*'         => ['string'],
            'remove_forms'              => ['nullable', 'array'],
            'remove_forms.*'            => ['string'],
            'remove_iso'                => ['nullable', 'array'],
            'remove_iso.*'              => ['string'],
        ]);

        // Save new uploads / replace singles:
        [$paths, /* $training */] = $this->storeFiles(
            $request,
            $client->company_name,
            $client->certificate_no,
            $client
        );

        $payload = array_filter([
            'auditor_code'      => $data['auditor_code']        ?? null,
            'auditor_name'      => $data['auditor_name']        ?? null,
            'assigned_standard' => $data['assigned_standard']   ?? null,
        ], fn($v) => !is_null($v));

        foreach ($paths as $key => $value) {
            if (!is_null($value)) $payload[$key] = $value;
        }

        // --- Handle removals for multi-file arrays ---
        $disk = 'public';

        // helper to remove selected paths from an existing array field
        $applyRemoval = function (string $field, array $remove = null) use ($client, $disk, &$payload) {
            if (!$remove) return;
            $existing = $client->$field ?? [];
            // keep only those NOT selected
            $keep = [];
            foreach ($existing as $p) {
                if (in_array($p, $remove, true)) {
                    Storage::disk($disk)->delete($p);
                } else {
                    $keep[] = $p;
                }
            }
            $payload[$field] = array_values($keep);
        };

        $applyRemoval('licenses_paths',       $data['remove_licenses'] ?? null);
        $applyRemoval('forms_evidence_paths', $data['remove_forms']    ?? null);
        $applyRemoval('iso_paths',            $data['remove_iso']      ?? null);

        $client->update($payload);

        return back()->with('success', 'Assessment updated.');
    }

    public function trainingIndex()
    {
        $clients = Client::orderBy('company_name')->get();

        return view('dashboard.training-segments', [
            'clients' => $clients,
        ]);
    }

    private function purgeTrainingYearFiles(string $dir, string $year, string $disk = 'public'): void
    {
        // List files under the training dir, then delete any matching "training-<year>(-N).pdf"
        foreach (Storage::disk($disk)->files($dir) as $path) {
            $basename = basename($path);
            if (preg_match('/^training-' . preg_quote($year, '/') . '(?:-\d+)?\.pdf$/i', $basename)) {
                Storage::disk($disk)->delete($path);
            }
        }
    }

    public function updateTraining(Request $request, Client $client)
    {
        $validated = $request->validate([
            'training_certificates'   => ['nullable', 'array'],
            'training_certificates.*' => ['file', 'mimes:pdf', 'max:10240'],
            'remove_training'         => ['nullable', 'array'],
            'remove_training.*'       => ['integer'],
        ]);

        $map  = $client->training_certificates ?? [];
        $disk = 'public';
        $dir  = 'clients/' . Str::slug($client->company_name) . '/training';

        // 1) Remove selected years (purge ALL variants)
        foreach ((array)($validated['remove_training'] ?? []) as $year) {
            $year = (string) $year;
            $this->purgeTrainingYearFiles($dir, $year, $disk);
            unset($map[$year]);
        }

        // 2) Save new uploads; first purge existing variants for that year
        foreach ($request->file('training_certificates', []) as $year => $file) {
            if (!preg_match('/^\d{4}$/', (string)$year)) continue;
            $year = (string) $year;

            // Ensure a clean slate so we can use a stable name without suffixes
            $this->purgeTrainingYearFiles($dir, $year, $disk);

            // Save as "training-<year>.pdf" (no -1, -2 anymore)
            $stored = $file->storeAs($dir, "training-{$year}.pdf", $disk);
            $map[$year] = $stored;
        }

        krsort($map);
        $client->update(['training_certificates' => $map]);

        return back()->with('success', 'Training certificates updated.');
    }

    public function isoIndex()
    {
        $clients = Client::orderBy('company_name')->get();

        // view file you just edited for this page
        return view('dashboard.endorsement', compact('clients'));
        // If your file is named differently, adjust the view path accordingly.
    }

    /** Update ISO certificates: remove selected + append new uploads */
    public function updateIso(Request $request, Client $client)
    {
        $validated = $request->validate([
            'delete_iso'   => ['nullable', 'array'],
            'delete_iso.*' => ['integer'],

            'iso_files'    => ['nullable', 'array'],
            'iso_files.*'  => ['file', 'mimes:pdf', 'max:10240'], // 10MB each
        ]);

        $disk = 'public';
        $baseDir = 'clients/' . Str::slug($client->company_name) . '/iso';

        // current array of stored relative paths
        $paths = $client->iso_paths ?? [];

        // 1) Remove selected (by index)
        foreach ($validated['delete_iso'] ?? [] as $idx) {
            if (isset($paths[$idx])) {
                Storage::disk($disk)->delete($paths[$idx]);
                unset($paths[$idx]);
            }
        }
        // reindex after deletions
        $paths = array_values($paths);

        // 2) Append new uploads
        if ($request->hasFile('iso_files')) {
            foreach ($request->file('iso_files') as $i => $file) {
                // unique, collision-proof name: iso-1.pdf, iso-2.pdf ... with -N if exists
                $ext = $file->extension();
                $base = 'iso-' . (count($paths) + $i + 1);
                $candidate = $base . '.' . $ext;
                $n = 1;
                while (Storage::disk($disk)->exists("$baseDir/$candidate")) {
                    $candidate = $base . '-' . (++$n) . '.' . $ext;
                }
                $stored = $file->storeAs($baseDir, $candidate, $disk);
                $paths[] = $stored;
            }
        }

        $client->update(['iso_paths' => $paths]);

        return back()->with('success', 'ISO certificates updated.');
    }


    public function create()
    {
        return view('dashboard.add-clients');
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'company_name'     => ['required', 'string', 'max:255'],
            'audit_reference'  => ['nullable', 'string', 'max:255'],
            'pic_name'         => ['required', 'string', 'max:255'],
            'pic_phone'        => ['nullable', 'string', 'max:30'],

            'certificate_no'   => ['required', 'string', 'max:255', 'unique:clients,certificate_no'],
            'certificate_file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'issued_on'        => ['nullable', 'date'],
            'effective_date'   => ['nullable', 'date'],
            'expiry_date'      => ['nullable', 'date', 'after_or_equal:effective_date'],

            'auditor_code'     => ['nullable', 'string', 'max:100'],
            'auditor_name'     => ['nullable', 'string', 'max:255'],
            'assigned_standard' => ['nullable', 'string', 'max:255'],

            'report_file'            => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'company_profile_file'   => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'ssm_file'               => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'sop_file'               => ['nullable', 'file', 'mimes:pdf', 'max:10240'],

            'licenses_files'         => ['nullable', 'array'],
            'licenses_files.*'       => ['file', 'mimes:pdf', 'max:10240'],

            'forms_evidence_files'   => ['nullable', 'array'],
            'forms_evidence_files.*' => ['file', 'mimes:pdf', 'max:10240'],

            'iso_files'              => ['nullable', 'array'],
            'iso_files.*'            => ['file', 'mimes:pdf', 'max:10240'],

            'training_certificates'   => ['nullable', 'array'],
            'training_certificates.*' => ['file', 'mimes:pdf', 'max:10240'],
        ]);

        [$paths, $training] = $this->storeFiles($request, $data['company_name'], $data['certificate_no']);

        $client = Client::create(array_merge($data, $paths, [
            'training_certificates' => $training,
        ]));

        return redirect()
            ->route('dashboard.clients.create')
            ->with('success', 'Client saved. You can add another client now.');
    }

    public function update(Request $request, Client $client)
    {
        $data = $request->validate([
            'company_name'     => ['required', 'string', 'max:255'],
            'audit_reference'  => ['nullable', 'string', 'max:255'],
            'pic_name'         => ['required', 'string', 'max:255'],
            'pic_phone'        => ['nullable', 'string', 'max:30'],

            'certificate_no'   => ['required', 'string', 'max:255', Rule::unique('clients', 'certificate_no')->ignore($client->id)],
            'certificate_file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'issued_on'        => ['nullable', 'date'],
            'effective_date'   => ['nullable', 'date'],
            'expiry_date'      => ['nullable', 'date', 'after_or_equal:effective_date'],

            'auditor_code'     => ['nullable', 'string', 'max:100'],
            'auditor_name'     => ['nullable', 'string', 'max:255'],
            'assigned_standard' => ['nullable', 'string', 'max:255'],

            'report_file'            => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'company_profile_file'   => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'ssm_file'               => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'sop_file'               => ['nullable', 'file', 'mimes:pdf', 'max:10240'],

            'licenses_files'         => ['nullable', 'array'],
            'licenses_files.*'       => ['file', 'mimes:pdf', 'max:10240'],
            'forms_evidence_files'   => ['nullable', 'array'],
            'forms_evidence_files.*' => ['file', 'mimes:pdf', 'max:10240'],
            'iso_files'              => ['nullable', 'array'],
            'iso_files.*'            => ['file', 'mimes:pdf', 'max:10240'],

            'training_certificates'   => ['nullable', 'array'],
            'training_certificates.*' => ['file', 'mimes:pdf', 'max:10240'],
        ]);

        // Store new uploads (don’t delete existing arrays unless new files provided)
        [$paths, $training] = $this->storeFiles($request, $data['company_name'], $data['certificate_no'], $client);

        $payload = array_merge($data, array_filter($paths, fn($v) => !is_null($v)));
        if (!empty($training)) {
            // merge: keep existing years, override uploaded years
            $payload['training_certificates'] = array_merge($client->training_certificates ?? [], $training);
        }

        $client->update($payload);

        return redirect()->route('dashboard.clients.index')->with('success', 'Client updated.');
    }

    public function destroy(Client $client)
    {
        // Clean up all stored files
        foreach (
            [
                'certificate_path',
                'report_path',
                'company_profile_path',
                'ssm_path',
                'sop_path',
            ] as $single
        ) {
            if ($client->$single) Storage::disk('public')->delete($client->$single);
        }
        foreach (['licenses_paths', 'forms_evidence_paths', 'iso_paths'] as $multi) {
            foreach (($client->$multi ?? []) as $p) {
                Storage::disk('public')->delete($p);
            }
        }
        foreach (($client->training_certificates ?? []) as $p) {
            Storage::disk('public')->delete($p);
        }

        $client->delete();
        return back()->with('success', 'Client deleted.');
    }

    /** Store files with friendly names; returns [$paths, $trainingMap] */
    private function storeFiles(Request $request, string $companyName, string $certNo, ?Client $existing = null): array
    {
        $disk = 'public';
        $baseDir = 'clients/' . Str::slug($companyName);

        $saveAs = function ($file, $dir, $base) use ($disk) {
            $ext = $file->extension();
            $name = $base . '.' . $ext;
            $candidate = $name;
            $i = 1;
            while (Storage::disk($disk)->exists("$dir/$candidate")) {
                $candidate = $base . '-' . ($i++) . '.' . $ext;
            }
            return $file->storeAs($dir, $candidate, $disk);
        };

        $paths = [
            'certificate_path'     => null,
            'report_path'          => null,
            'company_profile_path' => null,
            'ssm_path'             => null,
            'sop_path'             => null,
            'licenses_paths'       => $existing?->licenses_paths ?? [],
            'forms_evidence_paths' => $existing?->forms_evidence_paths ?? [],
            'iso_paths'            => $existing?->iso_paths ?? [],
        ];

        // Certification
        if ($request->hasFile('certificate_file')) {
            if ($existing?->certificate_path) Storage::disk($disk)->delete($existing->certificate_path);
            $paths['certificate_path'] = $saveAs(
                $request->file('certificate_file'),
                "$baseDir/certifications",
                Str::slug($companyName . '-' . $certNo)
            );
        }

        // Singles
        if ($request->hasFile('report_file')) {
            if ($existing?->report_path) Storage::disk($disk)->delete($existing->report_path);
            $paths['report_path'] = $saveAs($request->file('report_file'), "$baseDir/assessment", 'report');
        }
        if ($request->hasFile('company_profile_file')) {
            if ($existing?->company_profile_path) Storage::disk($disk)->delete($existing->company_profile_path);
            $paths['company_profile_path'] = $saveAs($request->file('company_profile_file'), "$baseDir/assessment", 'company-profile');
        }
        if ($request->hasFile('ssm_file')) {
            if ($existing?->ssm_path) Storage::disk($disk)->delete($existing->ssm_path);
            $paths['ssm_path'] = $saveAs($request->file('ssm_file'), "$baseDir/assessment", 'ssm');
        }
        if ($request->hasFile('sop_file')) {
            if ($existing?->sop_path) Storage::disk($disk)->delete($existing->sop_path);
            $paths['sop_path'] = $saveAs($request->file('sop_file'), "$baseDir/assessment", 'sop');
        }

        // Multi-arrays (append new files)
        foreach ($request->file('licenses_files', []) as $i => $file) {
            $paths['licenses_paths'][] = $saveAs($file, "$baseDir/licenses", 'license-' . (count($paths['licenses_paths']) + $i + 1));
        }
        foreach ($request->file('forms_evidence_files', []) as $i => $file) {
            $paths['forms_evidence_paths'][] = $saveAs($file, "$baseDir/forms-evidence", 'forms-evidence-' . (count($paths['forms_evidence_paths']) + $i + 1));
        }
        foreach ($request->file('iso_files', []) as $i => $file) {
            $paths['iso_paths'][] = $saveAs($file, "$baseDir/iso", 'iso-' . (count($paths['iso_paths']) + $i + 1));
        }

        // Training year => path (merge in update)
        $training = [];
        foreach ($request->file('training_certificates', []) as $year => $file) {
            if (preg_match('/^\d{4}$/', (string)$year)) {
                $training[$year] = $saveAs($file, "$baseDir/training", "training-$year");
            }
        }

        return [$paths, $training];
    }
}
