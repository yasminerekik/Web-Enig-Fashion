<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class ModifyEmojiColumnInFormsTable extends Migration
{
    public function up()
    {
        Schema::table('forms', function (Blueprint $table) {
            $table->string('emoji')->nullable()->change();
        });
    }

    public function down()
    {
        Schema::table('forms', function (Blueprint $table) {
            $table->integer('emoji')->nullable()->change();
        });
    }
}
