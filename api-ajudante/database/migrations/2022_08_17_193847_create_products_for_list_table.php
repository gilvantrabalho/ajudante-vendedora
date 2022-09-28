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
        Schema::create('products_for_list', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("list_prods_id");
            $table->string("name");
            $table->string("status");
            $table->timestamps();

            $table->foreign("list_prods_id")->references("id")->on("list_prods");
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('products_for_list');
    }
};
