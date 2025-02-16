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
        Schema::create('Payment', function (Blueprint $table) {
            $table->id();
            $table->string('customer');
            $table->string('billingType');
            $table->float('value');
            $table->date('dueDate');
            $table->string('description')->nullable();
            $table->integer('daysAfterDueDateToRegistrationCancellation')->nullable();
            $table->string('externalReference')->nullable();
            $table->integer('installmentCount')->nullable();
            $table->float('totalValue')->nullable();
            $table->boolean('postalService')->nullable();
            $table->json('discount')->nullable();
            $table->json('interest')->nullable();
            $table->json('fine')->nullable();
            $table->json('split')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('Payment');
    }
};
