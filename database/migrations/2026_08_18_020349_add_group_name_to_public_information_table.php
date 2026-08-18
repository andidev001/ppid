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
        Schema::table('public_information', function (Blueprint $table) {
            $table->string('group_name')->nullable()->after('category')->comment('Contoh: A. Informasi Profil Sekolah');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('public_information', function (Blueprint $table) {
            $table->dropColumn('group_name');
        });
    }
};
