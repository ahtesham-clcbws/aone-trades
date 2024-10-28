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
            $table->enum('type', ['Bank', 'UPI', 'USDT'])->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_withdrawals', function (Blueprint $table) {
            $table->dropColumn('type');
        });
    }
};
