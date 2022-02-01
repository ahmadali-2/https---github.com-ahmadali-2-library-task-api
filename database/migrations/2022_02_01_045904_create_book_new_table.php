<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateBookNewTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('book_new', function (Blueprint $table) {
            $table->id();
            $table->String("name");
            $table->unsignedBigInteger("rack_id");
            $table->String("author");
            $table->String("published_year");
            $table->foreign('rack_id')->references('id')->on('racks');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('book_new');
    }
}
