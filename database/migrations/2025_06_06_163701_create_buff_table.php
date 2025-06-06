<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('buffs', function (Blueprint $t) {
            $t->id();
            $t->string('code')->unique();         // FOCUS_MEDITATION, etc.
            $t->string('name');
            $t->text('description')->nullable();
            $t->decimal('multiplier', 4, 2);      // e.g. 0.15
            $t->integer('duration');              // minutes
            $t->json('applies_to');               // ["cognitive"], ["physical"], etc.
            $t->boolean('stackable')->default(false);
            $t->unsignedTinyInteger('max_stacks')->default(1);
            $t->unsignedSmallInteger('cooldown')->default(0); // hours
            $t->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('buffs');
    }
};
