<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddPromotionColumnsToProductsTable extends Migration
{
    public function up()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->decimal('promotion_percentage', 5, 2)->default(0);
            $table->date('promotion_start_date')->nullable();
            $table->date('promotion_end_date')->nullable();
        });
    }

    public function down()
    {
        Schema::table('products', function (Blueprint $table) {
            $table->dropColumn('promotion_percentage');
            $table->dropColumn('promotion_start_date');
            $table->dropColumn('promotion_end_date');
        });
    }
}
