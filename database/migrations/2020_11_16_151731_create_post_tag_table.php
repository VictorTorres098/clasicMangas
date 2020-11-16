<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostTagTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('post_tag', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('post_id')->index();
            $table->unsignedBigInteger('tag_id')->index();

            $table->timestamps();

            //relation
            $table->foreign('post_id')->references('id')->on('posts')
                ->onDelete('cascade') //si nosotros eliminamos un usuario eliminamos todos los post referidos a ese usuario 
                ->onUpdate('cascade');

            $table->foreign('tag_id')->references('id')->on('tags')
                ->onDelete('cascade') //si nosotros eliminamos una categoria eliminamos todos los post referidos a esa categoria 
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('post_tag');
    }
}
