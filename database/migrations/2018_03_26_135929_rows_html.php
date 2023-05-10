<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class RowsHtml extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('rows_html', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('html_id')->unsigned();
            $table->foreign('html_id')->references('id')->on('generate_html');
            $table->string('content');
            $table->string('align');
            $table->string('type');
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
