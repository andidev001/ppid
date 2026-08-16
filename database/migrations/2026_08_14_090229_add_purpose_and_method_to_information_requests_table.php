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
            $table->string('information_purpose')->nullable();
            $table->string('obtaining_method')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('information_requests', function (Blueprint $table) {
            $table->dropColumn(['information_purpose', 'obtaining_method']);
        });
    }
};
