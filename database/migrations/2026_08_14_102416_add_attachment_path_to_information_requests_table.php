<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('information_requests', function (Blueprint $table) {
            $table->string('attachment_path')->nullable()->after('obtaining_method')->comment('File surat lampiran/permohonan pendukung');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('information_requests', function (Blueprint $table) {
            //
        });
    }
};
