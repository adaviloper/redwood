<?php

use App\Enums\StepTypes;
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
        Schema::create('scenario_steps', function (Blueprint $table) {
            $table->uuid('id')->primary();
            $table->enum('type', StepTypes::values());
            $table->text('copy');
            $table->json('action')->nullable();
            $table->foreignUuid('scenario_id')
                ->references('id')
                ->on('scenarios');
            $table->timestamps();
        });

        Schema::table('scenario_steps', function (Blueprint $table) {
            $table->foreignUuid('scenario_step_id');
                // ->constrained();
            $table->uuid('scenario_step_id')
                ->change()
                ->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('scenario_steps');
    }
};
