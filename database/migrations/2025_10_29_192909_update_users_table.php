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
        Schema::table(table: 'users',callback: function(Blueprint $table){
            $table->boolean(column: 'is_blocked')->default(value: false);
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::table(table: 'users',callback: function(Blueprint $table){
            $table->dropColumn(columns: 'is_blocked');
        });
    }
};
