<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateQuestionsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('questions', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->string('user_id');
            $table->string('lawyer_id')->nullable();
            $table->string('lawyer_name')->nullable();
            $table->string('date')->nullable();
            $table->string('price')->nullable();
            $table->string('status')->default('open');
            $table->string('paid')->nullable();
            $table->string('held')->nullable();
            $table->string('resolved')->nullable();
            $table->string('terms')->nullable();
            $table->string('name')->nullable();
            $table->string('question');
            $table->longText('answer')->nullable();
            $table->string('theme')->nullable();
            $table->string('category');
            $table->string('moderation')->nullable();
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
        Schema::dropIfExists('questions');
    }
}
