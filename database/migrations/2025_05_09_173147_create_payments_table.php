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
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('invoice_id');
            $table->foreign('invoice_id')->references('id')->on('invoices');
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->unsignedBigInteger('gateway_id');
            $table->foreign('gateway_id')->references('id')->on('payment_gateways'); 
            $table->decimal('amount', 10, 2);
            $table->dateTime('paid_at');
            $table->string('transaction_reference')->nullable(); // if coming from gateway
            $table->text('note')->nullable(); // optional note
            $table->integer('payment_status'); // 1=Success, 2=Refund, 3=chargeback
            $table->integer('compliance_verified')->default(0);
            $table->text('compliance_note')->nullable(); // optional note
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
        Schema::dropIfExists('payments');
    }
};
