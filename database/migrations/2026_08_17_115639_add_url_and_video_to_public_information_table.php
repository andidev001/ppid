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
            $table->string('file_path')->nullable()->change();
            $table->string('url')->nullable()->after('file_path');
            $table->text('video_embed')->nullable()->after('url');
            $table->string('info_type')->default('file')->after('description');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('public_information', function (Blueprint $table) {
            $table->string('file_path')->nullable(false)->change();
            $table->dropColumn(['url', 'video_embed', 'info_type']);
        });
    }
};
