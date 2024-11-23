<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ChangePostIdToVarchar extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        // Change the `id` column in the `posts` table to a VARCHAR
        Schema::table('posts', function (Blueprint $table) {
            // Modify the `id` column type
            $table->string('id')->change();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Revert the `id` column in the `posts` table back to an INTEGER
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('id')->change();
        });
    }
}
