<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLeadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('leads', function (Blueprint $table) {
            $table->id();
             
            $table->unsignedBigInteger('brand_id');
            $table->foreign('brand_id')->references('id')->on('brands');

            $table->string('title')->nullable();
            $table->string('name')->nullable();
            $table->string('email')->nullable();
            $table->string('phone')->nullable();
            $table->text('details')->nullable();
            $table->string('source')->nullable();
            $table->string('platform')->nullable();
            $table->float('value')->nullable();
            $table->string('lead_ip',50)->nullable();
            $table->string('lead_city',50)->nullable();
            $table->string('lead_state',50)->nullable();
            $table->string('lead_zip',50)->nullable();
            $table->string('lead_country',50)->nullable();
            $table->string('lead_url')->nullable();
            $table->integer('view')->default('0')->nullable();  
            $table->string('keyword',100)->nullable();
            $table->string('matchtype',100)->nullable();
            $table->string('msclkid',100)->nullable();
            $table->string('gclid',100)->nullable();   
            
            $table->unsignedBigInteger('status_id');
            $table->foreign('status_id')->references('id')->on('lead_statuses');
            
            $table->unsignedBigInteger('user_id');
            $table->foreign('user_id')->references('id')->on('users');
            
            $table->integer('creator_id')->default('0');

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
        Schema::dropIfExists('leads');
    }
}
