<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateOwDevtagsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('ow_devgroups', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name',128)->unique()->index();
            $table->string('comment',128);
            $table->unsignedInteger('parent_id')->nullable();
            $table->timestamps();
        });
        Schema::create('ow_devtags', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->increments('id');
            $table->string('name',128)->unique()->index();
            $table->string('comment',128);
            $table->unsignedInteger('group_id');
            $table->timestamps();
        });
        Schema::create('ow_devtag_relationships', function (Blueprint $table) {
            $table->engine = 'InnoDB';
            $table->bigIncrements('id');
            $table->unsignedBigInteger('dev_id')->index();
            $table->foreign('dev_id')->references('id')->on('ow_devices')->onDelete('cascade');;
            $table->unsignedInteger('tag_id')->index();
            $table->foreign('tag_id')->references('id')->on('ow_devtags')->onDelete('cascade');;
            $table->unique(['tag_id', 'dev_id']);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('ow_devtag_relationships');
        Schema::drop('ow_devtags');
        Schema::drop('ow_devgroups');
    }
}
