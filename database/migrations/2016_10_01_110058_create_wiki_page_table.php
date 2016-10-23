<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWikiPageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wiki_page', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('slug', 65535);
            $table->longText('description')->nullable();
            $table->integer('parent_id')->unsigned()->nullable();

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('wiki_id')->unsigned();
            $table->foreign('wiki_id')->references('id')->on('wiki')->onDelete('cascade');
            
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
        Schema::dropIfExists('wiki_page');
    }
}
