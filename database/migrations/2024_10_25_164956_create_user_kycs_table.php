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
        Schema::create('user_kycs', function (Blueprint $table) {
            $table->id();

            $table->foreignIdFor(User::class)->index();

            $table->string('name')->nullable();
            $table->string('pancard')->nullable();

            $table->string('pancard_file')->nullable();

            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();

            $table->string('bank_proof_file')->nullable();
            $table->string('address_proof_file')->nullable();

            $table->enum('status', ['approved', 'rejected', 'pending'])->default('pending');
            $table->string('reject_notes')->nullable();

            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_kycs');
    }
};
