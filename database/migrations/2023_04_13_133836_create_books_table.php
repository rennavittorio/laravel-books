<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('books', function (Blueprint $table) {
            $table->id();

            $table->string('isbn_code', 17);
            $table->string('title', 100)->unique();
            $table->string('slug', 255);
            $table->string('main_author', 100);
            $table->smallInteger('pages')->unsigned()->nullable();
            $table->boolean('isAvailable')->default(false);
            $table->tinyInteger('copies')->unsigned()->default(0);
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
        Schema::dropIfExists('books');
    }
};
