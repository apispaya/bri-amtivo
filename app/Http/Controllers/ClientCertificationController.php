<?php

namespace App\Http\Controllers;

use Illuminate\Support\Str;

use App\Models\ClientCertification;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Validation\Rule;

class ClientCertificationController extends Controller
{
    public function index()
    {
        // Use ->get() if you want DataTables to handle paging/search on the client
        $certs = ClientCertification::orderBy('company_name')->get();
        $clientCount = \App\Models\ClientCertification::distinct('company_name')->count('company_name');
        return view('dashboard.client-certifications', compact('certs', 'clientCount'));
    }

    public function store(Request $request)
    {
        $data = $request->validate([
            'company_name'    => ['required', 'string', 'max:255'],
            'pic_name'        => ['required', 'string', 'max:255'],
            'pic_phone'       => ['nullable', 'string', 'max:30'],
            'audit_reference' => ['nullable', 'string', 'max:255'],
            'certificate_no'  => ['required', 'string', 'max:255', 'unique:client_certifications,certificate_no'],
            'certificate_file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'], // 10MB
            'issued_on'       => ['nullable', 'date'],
            'effective_date'  => ['nullable', 'date'],
            'expiry_date'     => ['nullable', 'date', 'after_or_equal:effective_date'],
        ], [], [
            'pic_name'       => "client's PIC",
            'certificate_no' => 'certificate number',
            'certificate_file' => 'certificate (PDF)',
        ]);

        // Handle file upload (optional)
        if ($request->hasFile('certificate_file')) {
            $disk = 'public';
            $dir  = 'certifications';
            $ext  = $request->file('certificate_file')->extension(); // 'pdf' (validated)

            // Safer, more unique filename: acme-berhad-bri-ea-001.pdf
            $company = Str::slug($data['company_name']);
            $certno  = Str::slug($data['certificate_no']);
            $base    = trim($company . ($certno ? '-' . $certno : ''));
            $name    = $base . '.' . $ext;

            // Ensure we don't overwrite an existing file (append -1, -2, ...)
            $candidate = $name;
            $i = 1;
            while (Storage::disk($disk)->exists("$dir/$candidate")) {
                $candidate = $base . '-' . $i . '.' . $ext;
                $i++;
            }

            $data['certificate_path'] = $request->file('certificate_file')
                ->storeAs($dir, $candidate, $disk);
        }

        ClientCertification::create($data);

        return back()->with('success', 'Client certification added.');
    }

    public function update(Request $request, ClientCertification $cert)
    {
        $data = $request->validate([
            'company_name'    => ['required', 'string', 'max:255'],
            'pic_name'        => ['required', 'string', 'max:255'],
            'pic_phone'       => ['nullable', 'string', 'max:30'],
            'audit_reference' => ['nullable', 'string', 'max:255'],
            'certificate_no'  => [
                'required',
                'string',
                'max:255',
                Rule::unique('client_certifications', 'certificate_no')->ignore($cert->id),
            ],
            'certificate_file' => ['nullable', 'file', 'mimes:pdf', 'max:10240'],
            'issued_on'       => ['nullable', 'date'],
            'effective_date'  => ['nullable', 'date'],
            'expiry_date'     => ['nullable', 'date', 'after_or_equal:effective_date'],
        ]);

        // New file uploaded? Replace old
        if ($request->hasFile('certificate_file')) {
            // Delete the old file (if any)
            if ($cert->certificate_path) {
                Storage::disk('public')->delete($cert->certificate_path);
            }

            $disk = 'public';
            $dir  = 'certifications';
            $ext  = $request->file('certificate_file')->extension();

            $company = Str::slug($data['company_name']);
            $certno  = Str::slug($data['certificate_no']);
            $base    = trim($company . ($certno ? '-' . $certno : ''));
            $name    = $base . '.' . $ext;

            $candidate = $name;
            $i = 1;
            while (Storage::disk($disk)->exists("$dir/$candidate")) {
                $candidate = $base . '-' . $i . '.' . $ext;
                $i++;
            }

            $data['certificate_path'] = $request->file('certificate_file')
                ->storeAs($dir, $candidate, $disk);
        }

        $cert->update($data);

        return back()->with('success', 'Client certification updated.');
    }

    public function destroy(ClientCertification $cert)
    {
        if ($cert->certificate_path) {
            Storage::disk('public')->delete($cert->certificate_path);
        }
        $cert->delete();

        return back()->with('success', 'Client certification deleted.');
    }
}
