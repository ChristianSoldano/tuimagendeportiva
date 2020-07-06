<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateArticlesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('articles', function (Blueprint $table) {
            $table->bigIncrements('id');

            $table->bigInteger('user_id')->unsigned();
            $table->bigInteger('category_id')->unsigned();

            $table->string('title', 128);
            $table->string('slug', 128)->unique();

            $table->mediumText('excerpt'); //extracto de la noticia
            $table->text('body');
            $table->enum('status', ['PUBLISHED', 'IN_REVIEW', 'REJECTED'] )->default('IN_REVIEW');

            $table->string('image', 128); // imagen
            $table->mediumText('observations')->nullable();
            $table->timestamps();

            //Relaciones
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('category_id')->references('id')->on('categories')->onDelete('cascade')->onUpdate('cascade');

            
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('articles');
    }
}
