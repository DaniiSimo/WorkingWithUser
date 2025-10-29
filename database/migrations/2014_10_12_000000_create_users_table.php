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
        Schema::create(table: 'users', callback: function (Blueprint $table) {
            $table->id();
            $table->string(column: 'name')
                ->nullable()
                ->default(value: null);
            $table->string(column: 'email')->unique();
            $table->string(column: 'username')->unique();
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
        Schema::dropIfExists(table: 'users');
    }
};
