<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rents', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('book_id');
            $table->foreign('book_id')->references('id')->on('books')->onUpdate('cascade')->onDelete('restrict');
            $table->unsignedBigInteger('partner_id');
            $table->foreign('partner_id')->references('id')->on('partners')->onUpdate('cascade')->onDelete('restrict');
            $table->integer('qty');
            $table->date('start_date');
            $table->date('end_date');
            $table->integer('times_extended')->default(0);
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
        Schema::dropIfExists('rents');
    }
}
