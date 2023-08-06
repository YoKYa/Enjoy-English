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
        Schema::create('panswers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('practice_id');
            $table->integer('nomor');
            $table->enum('type', [1, 2,3,4]);
            $table->enum('typeanswer', ['text','picture','audio']);
            $table->text('answer')->nullable();
            $table->text('data');
            $table->timestamps();
            $table->foreign('practice_id')->references('id')->on('practices')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('panswers');
    }
};
