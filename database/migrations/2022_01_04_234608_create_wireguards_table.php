<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateWireguardsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('wireguards', function (Blueprint $table) {
            $table->id();
            $table->boolean('ready')->default(0)->comment('Wether the wireguard has been set up.');
            $table->string('generated_public_key')->nullable();
            $table->unsignedBigInteger('customer_id')->nullable();
            $table->ipAddress('ip')->nullable();
            $table->timestamps();
            $table->foreign('customer_id')->references('id')->on('customers')->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('wireguards');
    }
}
