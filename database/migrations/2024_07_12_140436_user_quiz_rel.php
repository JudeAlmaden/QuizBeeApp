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
        Schema::create('user_quiz_rel', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->string('user')->references('id')->on('users')->onDelete('cascade');
            $table->bigInteger('quiz')->references('id')->on('quizzes')->onDelete('cascade');
            $table->string('relation')->nullable(false);
            $table->timestamp('created_at')->default(DB::raw('CURRENT_TIMESTAMP'));
            $table->timestamp('updated_at')->default(DB::raw('CURRENT_TIMESTAMP on update CURRENT_TIMESTAMP'));
        });

    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        schema::drop('user_quiz_rel');
    }
};
