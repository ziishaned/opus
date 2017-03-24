<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class UpdateVersion4NotificationsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->bigInteger('from_id')->unsigned()->nullable()->change();
        });
        Schema::table('notifications', function (Blueprint $table) {
            $table->renameColumn('expire_time', 'expires_at');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('notifications', function (Blueprint $table) {
            $table->renameColumn('expires_at', 'expire_time');
        });
        Schema::table('notifications', function (Blueprint $table) {
            $table->bigInteger('from_id')->unsigned()->change();
        });
    }
}
