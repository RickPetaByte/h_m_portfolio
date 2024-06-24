<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUserTextsTable extends Migration
{
    public function up()
    {
        Schema::create('user_texts', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('user_id');
            $table->text('text');
            $table->string('title')->nullable();
            $table->string('subtitle')->nullable();
            $table->string('picture')->nullable();
            $table->string('specialties')->nullable();
            $table->string('one')->nullable();
            $table->string('two')->nullable();
            $table->string('three')->nullable();
            $table->string('four')->nullable();
            $table->string('five')->nullable();
            $table->string('six')->nullable();
            $table->boolean('private')->default(true);
            $table->string('selected_image_alt')->nullable();
            $table->string('selected_color_image_alt')->nullable();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
        });
    }

    public function down()
    {
        Schema::dropIfExists('user_texts');
    }
}