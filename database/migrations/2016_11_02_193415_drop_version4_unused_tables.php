<?php

use Illuminate\Database\Migrations\Migration;

class DropVersion4UnusedTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('notifications_categories_in_groups');
        Schema::dropIfExists('notification_groups');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // no way to rollback this
    }
}
