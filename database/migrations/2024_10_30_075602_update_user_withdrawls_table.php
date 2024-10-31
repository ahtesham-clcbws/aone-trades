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
        Schema::table('user_withdrawls', function (Blueprint $table) {
            $table->string('address')->nullable(); // will be account number, UPI ID, USDT address
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('ifsc_code')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_withdrawls', function (Blueprint $table) {
            $table->dropColumn('address');
            $table->dropColumn('bank_name');
            $table->dropColumn('bank_branch');
            $table->dropColumn('ifsc_code');
        });
    }
};
