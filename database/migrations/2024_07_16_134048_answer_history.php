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
        Schema::create('answer_history', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->bigInteger('question')->references('id')->on('questions')->onDelete('cascade');
            $table->string('user')->references('id')->on('users')->onDelete('cascade');
            $table->string('answer')->nullable(false);
            $table->string('evaluation')->nullable(false)->default('Not Evaluated');
            $table->decimal('points', 8, 2)->default(0);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });
    }


    public function down(): void
    {
        schema::drop('answer_history');
    }
};
