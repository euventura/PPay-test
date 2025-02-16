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
        Schema::create('payment', function (Blueprint $table) {
            $table->id();
            $table->string('customer');
            $table->string('billing_type');
            $table->float('value');
            $table->date('due_date');
            $table->string('description')->nullable();
            $table->integer('days_after_due_date_to_registration_cancellation')->nullable();
            $table->string('external_reference')->nullable();
            $table->integer('installment_count')->nullable();
            $table->float('total_value')->nullable();
            $table->boolean('postal_service')->nullable();
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
        Schema::dropIfExists('payment');
    }
};
