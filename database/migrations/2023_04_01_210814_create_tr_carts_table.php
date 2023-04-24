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
        Schema::create('tr_carts', function (Blueprint $table) {
            $table->id();
            $table->integer('biodata_id')->nullable();
            $table->integer('catalogue_id')->nullable();
            $table->integer('hargasize_id')->nullable();
            $table->decimal('qty', 8, 0)->nullable();
            $table->softDeletes();
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
        Schema::dropIfExists('tr_carts');
    }
};
