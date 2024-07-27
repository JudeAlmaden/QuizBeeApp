<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('category')->references('id')->on('categories')->onDelete('cascade');
            $table->string('question')->nullable(false);
            $table->string('answer')->nullable(false);
            $table->integer('points')->nullable(false);
            $table->integer('bonus')->nullable(false) -> default(0);
            $table->string('status')->nullable(false) -> default("Available");
            $table->string('isAccepting')->nullable(false) -> default("False");
            $table->string('format')->nullable(false);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::drop('questions');
    }
};
