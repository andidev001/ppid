<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration {
    /**
     * Run the migrations.
     * Changes the `value` column in the `settings` table from TEXT (max 65,535 bytes)
     * to LONGTEXT (max 4 GB) to support rich HTML content with embedded base64 images.
     */
    public function up(): void
    {
        DB::statement('ALTER TABLE `settings` MODIFY `value` LONGTEXT NULL');
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        DB::statement('ALTER TABLE `settings` MODIFY `value` TEXT NULL');
    }
};
