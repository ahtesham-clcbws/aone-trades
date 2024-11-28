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
        Schema::create('desposit_details', function (Blueprint $table) {
            $table->id();
            $table->enum('type', ['tether', 'upi', 'bank']);
            $table->string('address'); // tether address, upi address, bank account number
            $table->string('qr_code')->nullable();
            $table->string('bank_name')->nullable();
            $table->string('account_name')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->string('micr_code')->nullable();
            $table->string('branch_address')->nullable();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('desposit_details');
    }
};
