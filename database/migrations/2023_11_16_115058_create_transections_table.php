<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('transections', function (Blueprint $table) {
            $table->id();
            $table->float('paid_amount');
            $table->string('currency');
            $table->unsignedBigInteger('user_id');
            $table->enum('status_code',['authorized', 'decline', 'refunded']);
            $table->date('payment_date');
            $table->string('parent_identification')->unique();
            $table->timestamps();
            $table->foreign('user_id')->references('id')->on('users')
                                      ->onDelete('cascade')
                                      ->onUpdate('cascade');

        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('transections');
    }
};
