<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBooksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->string('isbn');
            $table->integer('pages');
            $table->integer('qty');
            $table->unsignedBigInteger('author_id');
            $table->foreign('author_id')->references('id')->on('authors')->onUpdate('cascade')->onDelete('cascade');
            $table->unsignedBigInteger('editorial_id');
            $table->foreign('editorial_id')->references('id')->on('editorials')->onUpdate('cascade')->onDelete('cascade');
            $table->string('category')->nullable();
            $table->string('cover_type')->nullable();
            $table->string('copyright')->nullable();
            $table->string('publishing_place')->nullable();
            $table->date('release_date')->nullable();
            $table->string('photo')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('books');
    }
}
