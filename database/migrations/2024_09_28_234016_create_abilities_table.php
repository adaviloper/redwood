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
        Schema::create('abilities', function (Blueprint $table) {
            $table->id();
            $table->foreignId('player_character_id')->constrained()->onDelete('cascade');
            $table->enum('name', Abilities::values());
            $table->string('type');
            $table->integer('value');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('abilities', function (Blueprint $table) {
            $table->dropForeign(['player_character_id']);
        });
        Schema::dropIfExists('abilities');
    }
};
