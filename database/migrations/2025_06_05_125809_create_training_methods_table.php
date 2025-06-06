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
        Schema::create('training_methods', function (Blueprint $table) {
            $table->id();

            // Add a nullable foreign key to users. If you want to require every category to have an owning user, drop nullable().
            $table->foreignId('user_id')
                ->constrained()
                ->onDelete('cascade');

            $table->string('name');
            $table->timestamps();
            // We want each user to have unique category names (but different users can share the same text):
            // correct: composite unique on both columns together
            $table->unique(['user_id', 'name']);

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('training_methods');
    }
};
