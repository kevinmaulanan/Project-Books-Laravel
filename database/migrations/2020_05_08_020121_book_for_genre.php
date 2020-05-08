<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class BookForGenre extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_for_genre', function (Blueprint $table) {
            $table->bigIncrements('id');
            $table->unsignedBigInteger('id_book');
            $table->unsignedBigInteger('id_genre');

            $table->foreign('id_book')->references('id')->on('books')->onDelete('cascade')->onUpdate('cascade');
            $table->foreign('id_genre')->references('id')->on('genres')->onDelete('cascade')->onUpdate('cascade');
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
        //
    }
}
