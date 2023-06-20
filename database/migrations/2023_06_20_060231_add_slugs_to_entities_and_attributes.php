<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('entities', function (Blueprint $table) {
            $table->string('slug')->index()->after('ulid');
        });

        Schema::table('attributes', function (Blueprint $table) {
            $table->string('slug')->index()->after('ulid');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('entities', function (Blueprint $table) {
            $table->dropColumn('slug');
        });

        Schema::table('attributes', function (Blueprint $table) {
            $table->dropColumn('slug');
        });
    }
};
