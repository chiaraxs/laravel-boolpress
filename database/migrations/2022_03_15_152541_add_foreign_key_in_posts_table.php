<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyInPostsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */

    //  funzione con cui dichiaro la foreign key
    public function up()
    {
        // USER_ID/CATEGORY_ID
        Schema::table('posts', function (Blueprint $table) {
            $table->unsignedBigInteger('user_id')->nullable();

            $table->foreign('user_id')              // indico che la foreign key è user_id
                ->references('id')                 // indico la colonna a cui fa riferimento la foreign key
                ->on('users');                      // indico la tabella a cui fa riferimento la foreign key

                
            $table->unsignedBigInteger('category_id')->nullable();

            $table->foreign('category_id')
                ->references('id')
                ->on('categories');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table('posts', function (Blueprint $table) {
            $table->dropForeign('posts_user_id_foreign');            // scollego la foreign key dalla tabella
            $table->dropColumn('user_id');           // la elimino

            $table->dropForeign('posts_category_id_foreign');          // scollego la foreign key dalla tabella
            $table->dropColumn('category_id');           // la elimino
        });
    }
}
