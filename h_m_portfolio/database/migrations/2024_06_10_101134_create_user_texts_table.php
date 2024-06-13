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
            $table->string('title', 18)->nullable();
            $table->string('subtitle', 18)->nullable();
            $table->string('picture')->nullable();
            $table->string('one', 20)->nullable();
            $table->string('two', 20)->nullable();
            $table->string('three', 20)->nullable();
            $table->string('four', 20)->nullable();
            $table->string('five', 20)->nullable();
            $table->string('six', 20)->nullable();
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