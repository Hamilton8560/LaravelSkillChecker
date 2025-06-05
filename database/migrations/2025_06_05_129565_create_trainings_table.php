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
           Schema::create('trainings', function (Blueprint $table) {
        $table->id();

        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->foreignId('training_category_id')->constrained('training_categories')->onDelete('restrict');
        $table->foreignId('training_method_id')->constrained('training_methods')->onDelete('restrict');

        $table->unsignedInteger('duration');
        $table->unsignedTinyInteger('RPE');
        $table->text('notes')->nullable();
        $table->text('task_description');
        $table->text('what_you_learned');

        // ← Score must appear here exactly once:
        $table->double('score', 8, 2)->default(0);

        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('trainings');
    }
};
