<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class SupprimerTableForm extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::dropIfExists('form');
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        // Si vous souhaitez créer à nouveau la table "form" dans une migration inverse,
        // vous pouvez le faire ici, mais ce n'est pas nécessaire si vous supprimez définitivement la table.
    }
}

