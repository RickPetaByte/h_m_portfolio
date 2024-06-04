<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePortfoliosTable extends Migration
{
    public function up()
    {
        Schema::create('portfolios', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');
            $table->string('title', 18);
            $table->string('subtitle', 18);
            $table->string('picture')->nullable();
            $table->string('one', 20)->nullable();
            $table->string('two', 20)->nullable();
            $table->string('three', 20)->nullable();
            $table->string('four', 20)->nullable();
            $table->string('five', 20)->nullable();
            $table->string('six', 20)->nullable();
            $table->text('about')->nullable();
            $table->boolean('private')->default(true);
            $table->string('selected_image_alt');
            $table->string('selected_color_image_alt');
            $table->timestamps();
        });
    }

    public function down()
    {
        Schema::table('portfolios', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');
        });
    }
}