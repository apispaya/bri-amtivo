<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('client_certifications', function (Blueprint $table) {
            $table->id();
            $table->string('company_name');
            $table->string('pic_name');              // client's PIC
            $table->string('pic_phone')->nullable(); // simple text to allow +, spaces
            $table->string('audit_reference')->nullable();
            $table->string('certificate_no')->unique();
            $table->string('certificate_path')->nullable(); // storage path to PDF
            $table->date('issued_on')->nullable();
            $table->date('effective_date')->nullable();
            $table->date('expiry_date')->nullable();
            $table->timestamps();

            $table->index('company_name');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('client_certifications');
    }
};
