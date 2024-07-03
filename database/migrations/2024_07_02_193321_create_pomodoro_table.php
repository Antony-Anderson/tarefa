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
        Schema::create('pomodoro', function (Blueprint $table) {
            $table->id();
            $table->string('descricao')->nullable();
            $table->integer('tempo');
            $table->unsignedBigInteger('user_id');
            $table->timestamps();
            $table->softDeletes();

            //Relacions
            $table->foreign('user_id')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('pomodoro');
    }
};
