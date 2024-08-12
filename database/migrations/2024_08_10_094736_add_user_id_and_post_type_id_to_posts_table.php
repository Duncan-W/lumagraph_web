<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            // Add columns only if they don't exist
            if (!Schema::hasColumn('posts', 'user_id')) {
                $table->bigInteger('user_id')->unsigned()->nullable();
            }

            if (!Schema::hasColumn('posts', 'post_type_id')) {
                $table->bigInteger('post_type_id')->unsigned()->nullable();
            }
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign(['user_id']);
            $table->dropColumn('user_id');

            $table->dropForeign(['post_type_id']);
            $table->dropColumn('post_type_id');
        });
    }
};
