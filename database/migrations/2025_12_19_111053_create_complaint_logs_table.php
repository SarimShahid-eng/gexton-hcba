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

        Schema::create('complaint_logs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('complaint_id')->constrained();
            $table->text('action');
            $table->foreignId('performed_by')->nullable()->constrained();
            $table->timestamp('timestamp');
            $table->foreignId('performed_by_id');
            $table->timestamps();
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('complaint_logs');
    }
};
