<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentGatewaysTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_gateways', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('merchant_id');
            $table->foreign('merchant_id')->references('id')->on('merchants');
            $table->string('descriptor');
            $table->string('email');
            $table->string('currency');
            $table->decimal('limit')->default('0.00');

            //Authorize.Net Keys
            $table->string('live_auth_login_id')->nullable();
            $table->string('live_auth_transaction_key')->nullable();
            $table->string('test_auth_login_id')->nullable();
            $table->string('test_auth_transaction_key')->nullable();
            //Strip Keys
            $table->string('live_stripe_publishable_key')->nullable();
            $table->string('live_stripe_secret_key')->nullable();
            $table->string('test_stripe_publishable_key')->nullable();
            $table->string('test_stripe_secret_key')->nullable();
            //PayPal
            $table->string('test_paypal_api_username')->nullable();
            $table->string('test_paypal_api_password')->nullable();
            $table->string('test_paypal_api_signature')->nullable();
            $table->string('live_paypal_api_username')->nullable();
            $table->string('live_paypal_api_password')->nullable();
            $table->string('live_paypal_api_signature')->nullable();
            //braintree
            $table->string('test_braintree_merchantId')->nullable();
            $table->string('test_braintree_publicKey')->nullable();
            $table->string('test_braintree_privateKey')->nullable();
            $table->string('live_braintree_merchantId')->nullable();
            $table->string('live_braintree_publicKey')->nullable();
            $table->string('live_braintree_privateKey')->nullable();
            //square
            $table->string('square_sandbox_application_id')->nullable();
            $table->string('square_sandbox_access_token')->nullable();
            $table->string('square_sandbox_location_id')->nullable();
            $table->string('square_production_application_id')->nullable();
            $table->string('square_production_access_token')->nullable();
            $table->string('square_production_Location_id')->nullable();
            //2checkout
            $table->string('twocheckout_sandbox_seller_id')->nullable();
            $table->string('twocheckout_sandbox_publishable_key')->nullable();
            $table->string('twocheckout_sandbox_private_key')->nullable();
            $table->string('twocheckout_live_seller_id')->nullable();
            $table->string('twocheckout_live_publishable_key')->nullable();
            $table->string('twocheckout_live_private_key')->nullable();

            $table->integer('environment')->default(0);
            $table->integer('status')->default(0);
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
        Schema::dropIfExists('payment_gateways');
    }
}
