<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRolesTable extends Migration
{
    public function up()
{
    Schema::table('orders', function (Blueprint $table) {
        $table->string('nom')->nullable();
        $table->string('prenom')->nullable();
        $table->string('adresse')->nullable();
        $table->string('contact')->nullable();
    });
}

}