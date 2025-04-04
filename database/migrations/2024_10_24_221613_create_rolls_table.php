<?php

use App\Enums\Abilities;
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('rolls', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained();
            $table->foreignUuid('scenario_step_id')->constrained();
            $table->foreignId('player_character_id')->constrained();
            $table->integer('total');
            $table->unsignedInteger('die_result');
            $table->enum('ability', Abilities::values());
            $table->timestamps();

            $table->unique(['user_id', 'scenario_step_id', 'player_character_id']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('rolls');
    }
};
