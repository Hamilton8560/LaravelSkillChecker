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
        Schema::create('user_buffs', function (Blueprint $t) {
            $t->id();
            $t->foreignId('user_id')->constrained()->cascadeOnDelete();
            $t->foreignId('buff_id')->constrained()->cascadeOnDelete();
            $t->timestamp('starts_at');
            $t->timestamp('ends_at');
            $t->foreignId('consumed_session_id')->nullable(); //training_id
            $t->unique(['user_id', 'buff_id', 'starts_at']);  //prevent accidental dups
            $t->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_buffs');
    }
};
