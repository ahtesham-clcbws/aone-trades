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
        Schema::table('user_kycs', function (Blueprint $table) {
            $table->dropColumn('name');
            $table->dropColumn('pancard');

            $table->dropColumn('bank_name');
            $table->dropColumn('account_number');
            $table->dropColumn('ifsc_code');

            $table->dropColumn('bank_proof_file');

            $table->string('address_proof_file_back')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_kycs', function (Blueprint $table) {
            $table->string('name')->nullable();
            $table->string('pancard')->nullable();

            $table->string('bank_name')->nullable();
            $table->string('account_number')->nullable();
            $table->string('ifsc_code')->nullable();

            $table->string('bank_proof_file')->nullable();

            $table->dropColumn('address_proof_file_back');
        });
    }
};
