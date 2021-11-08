<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddForeignKeyPostsTable extends Migration
{
    /**
     * Run the migrations.
     *      
     * creating my table with the Cli --table=posts laravel automatically prepare the schemas to do what i need
     *i created this migration with this name bacause it is more human friendly, i instantly understand what it does, 
     * calling it update_posts_table would have been less direct
     * 
     * @return void
     */
    public function up()
    {
        Schema::table('posts', function (Blueprint $table) {
            // so now i'm telling to laravel create a new column category-id put it after slug and make it nullable
            $table->unsignedBigInteger('category_id')->nullable()->after('slug');
            //now make di category_id a foreign key and refere it to the 'id' of categories table creating a real relation between the 2 tables
            $table->foreign('category_id')->references('id')->on('categories');
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
            //now i need to 2 two different things
            //dropForeign will drop the index it created when i linked the id with the category_id
            $table->dropForeign('posts_category_id_foreign');
            //this will just drop the column just created in case of callback and not all the table
            $table->dropColumn('category_id');
        });
    }
}
