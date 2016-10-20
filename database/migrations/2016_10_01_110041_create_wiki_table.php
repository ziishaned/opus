
<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateWikiTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wiki', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->longText('description')->nullable();
            $table->enum('wiki_type', [
                'personal',
                'organization',
            ]);
            $table->enum('visibilty', [
                'private',
                'public'
            ]);

            $table->integer('user_id')->unsigned();
            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');

            $table->integer('organization_id')->unsigned()->nullable();
            $table->foreign('organization_id')->references('id')->on('organization')->onDelete('cascade');

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
        Schema::dropIfExists('wiki');
    }
}
