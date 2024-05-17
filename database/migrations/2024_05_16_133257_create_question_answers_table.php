<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateQuestionAnswersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('question_answers', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('question_id')->nullable();
            $table->unsignedBigInteger('option_id')->nullable();
            $table->unsignedBigInteger('user_id')->nullable();
            $table->string('plan_type')->nullable();
            $table->foreign('question_id')->references('id')->on('questions')->cascadeOnDelete();
            $table->foreign('user_id')->references('id')->on('users')->cascadeOnDelete();
            $table->foreign('option_id')->references('id')->on('question_options')->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('question_answers');
    }
}
