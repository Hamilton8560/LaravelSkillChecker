<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        // SQLite doesn't handle ALTER TABLE with default values well
        // So we'll add the column without default, then update all rows
        Schema::table('training_categories', function (Blueprint $table) {
            $table->string('type')->nullable();
        });

        // Update all existing rows to have the default value
        DB::table('training_categories')->update(['type' => 'cognitive']);

        // Now make the column non-nullable
        Schema::table('training_categories', function (Blueprint $table) {
            $table->string('type')->nullable(false)->change();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('training_categories', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};