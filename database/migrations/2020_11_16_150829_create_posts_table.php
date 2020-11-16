<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('posts', function (Blueprint $table) {
            $table->id();

            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('category_id')->index();
            $table->string('name',128); //laravel 5.5
            $table->string('slug',128)->unique(); //url amigable = laravel-5-5

            $table->mediumText('exerpt')->nullable();
            $table->text('body');
            $table->enum('status', ['PUBLISHED', 'DRAFT'])->default('DRAFT'); //SI al crear un post no especificamos un estado tomara automaticamente el estado DRAFT(BORRADOR)
            
            $table->string('file',128)->nullable();

            $table->timestamps();

            //relaciones
            //user->category

            $table->foreign('user_id')->references('id')->on('users')
                ->onDelete('cascade') //si nosotros eliminamos un usuario eliminamos todos los post referidos a ese usuario 
                ->onUpdate('cascade');

            $table->foreign('category_id')->references('id')->on('categories')
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
        Schema::dropIfExists('posts');
    }
}
