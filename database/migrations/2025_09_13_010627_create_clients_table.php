<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('clients', function (Blueprint $table) {
            $table->id();

            // Company / PIC
            $table->string('company_name');
            $table->string('audit_reference')->nullable();
            $table->string('pic_name');
            $table->string('pic_phone')->nullable();

            // Certification (1 per client in this design)
            $table->string('certificate_no')->unique();
            $table->string('certificate_path')->nullable();
            $table->date('issued_on')->nullable();
            $table->date('effective_date')->nullable();
            $table->date('expiry_date')->nullable();

            // Assessment
            $table->string('auditor_code')->nullable();
            $table->string('auditor_name')->nullable();
            $table->string('assigned_standard')->nullable();

            // Document paths
            $table->string('report_path')->nullable();
            $table->string('company_profile_path')->nullable();
            $table->string('ssm_path')->nullable();
            $table->string('sop_path')->nullable();

            // Multi-docs
            $table->json('licenses_paths')->nullable();
            $table->json('forms_evidence_paths')->nullable();
            $table->json('iso_paths')->nullable();

            // Training: { "2024": "storage path", ... }
            $table->json('training_certificates')->nullable();

            $table->timestamps();

            $table->index('company_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('clients');
    }
};
