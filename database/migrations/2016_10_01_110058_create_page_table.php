<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePageTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('page', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('parent_id')->nullable()->index();
            $table->integer('position')->nullable();
            $table->integer('lft')->nullable()->index();
            $table->integer('rgt')->nullable()->index();
            $table->integer('depth')->nullable();
            $table->string('name');
            $table->string('slug', 65535);
            $table->string('outline')->longText()->nullable();
            $table->longText('description')->nullable();
            $table->integer('user_id')->unsigned();
            $table->integer('wiki_id')->unsigned();
            $table->integer('team_id')->unsigned();
            $table->softDeletes();
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
        Schema::dropIfExists('page');
    }
}
