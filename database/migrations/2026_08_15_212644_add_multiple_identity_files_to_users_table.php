<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->string('identity_file_path_2')->nullable();
            $table->string('identity_file_path_3')->nullable();
            $table->string('identity_file_path_4')->nullable();
            $table->string('identity_file_path_5')->nullable();
        });
    }

    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn([
                'identity_file_path_2',
                'identity_file_path_3',
                'identity_file_path_4',
                'identity_file_path_5',
            ]);
        });
    }
};
