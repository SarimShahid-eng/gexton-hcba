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
        Schema::disableForeignKeyConstraints();

        Schema::create('member_balances', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->primary();
            $table->decimal('balance', 10, 2)->default(0);
            $table->timestamp('last_updated');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('member_balances');
    }
};
