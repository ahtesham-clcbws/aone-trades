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
        Schema::table('user_plan_requests', function (Blueprint $table) {
            $table->string('current_package');
            $table->string('reject_notes')->nullable();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('user_plan_requests', function (Blueprint $table) {
            $table->dropColumn('current_package');
            $table->dropColumn('reject_notes');
        });
    }
};
