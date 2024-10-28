<?php

use App\Models\User;
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
        Schema::create('user_transfer_details', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
            $table->enum('type', ['Bank', 'UPI', 'USDT'])->default('Bank');
            $table->string('address')->nullable(); // will be account number, UPI ID, USDT address
            $table->string('bank_name')->nullable();
            $table->string('bank_branch')->nullable();
            $table->string('ifsc_code')->nullable();
            $table->boolean('isActive')->default(true);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_transfer_details');
    }
};
