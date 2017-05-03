<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class ArchiveComments extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('archive_comments', function (Blueprint $table) {
           $table->increments('id');
           $table->integer('user_id');
           $table->integer('archive_id');
           $table->text('comment');
           $table->tinyInteger('deleted')->default(0);
           $table->dateTime('created_at');
           $table->timestamp('updated_at');
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
