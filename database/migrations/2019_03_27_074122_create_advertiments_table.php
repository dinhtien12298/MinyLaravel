<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateAdvertimentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('advertiments', function (Blueprint $table) {
            $table->increments('id');
            $table->string('title')->collation('utf8_unicode_ci');
            $table->string('link')->collation('utf8_unicode_ci');
            $table->string('image')->collation('utf8_unicode_ci');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('advertiments');
    }
}
