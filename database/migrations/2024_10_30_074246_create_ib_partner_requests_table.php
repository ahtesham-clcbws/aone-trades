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
        Schema::create('ib_partner_requests', function (Blueprint $table) {
            $table->id();
            $table->foreignIdFor(User::class);
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
        Schema::dropIfExists('ib_partner_requests');
    }
};
