<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('invoices', function (Blueprint $table) {
            $table->id();
            $table->string('invoice_number',50);
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands');
            $table->unsignedBigInteger('client_id');
            $table->foreign('client_id')->references('id')->on('clients');
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            $table->integer('creator_id')->nullable();
            $table->string('creator_role',10)->nullable()->default('USR');
            $table->decimal('amount'); 
            $table->date('due_date');
            $table->string('service')->nullable();
            $table->string('sales_type');
            $table->enum('status', ['draft','due','paid','refund','chargeback'])->default('due'); 
            $table->text('descriptione')->nullable();
            $table->string('currency')->default('USD');
            $table->unsignedBigInteger('gateway_id');
            $table->foreign('gateway_id')->references('id')->on('payment_gateways'); 
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
        Schema::dropIfExists('invoices');
    }
}
