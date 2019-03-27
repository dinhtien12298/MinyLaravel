<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('username')->collation('utf8_unicode_ci')->unique();
            $table->string('password')->collation('utf8_unicode_ci');
            $table->string('fullname')->collation('utf8_unicode_ci');
            $table->date('birth')->nullable();
            $table->integer('phone');
            $table->string('email')->collation('utf8_unicode_ci');
            $table->string('working')->collation('utf8_unicode_ci');
            $table->string('remember_token')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
