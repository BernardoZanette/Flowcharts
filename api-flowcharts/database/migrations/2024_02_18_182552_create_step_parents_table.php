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
        Schema::create('step_parents', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger("step_id")->nullable(false);
            $table->foreign("step_id")->references("id")->on("steps");

            $table->unsignedBigInteger("parent_step_id")->nullable(false);
            $table->foreign("parent_step_id")->references("id")->on("steps");

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('step_parents');
    }
};
