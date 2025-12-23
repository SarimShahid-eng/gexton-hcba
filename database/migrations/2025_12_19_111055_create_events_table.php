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

        Schema::create('events', function (Blueprint $table) {
            $table->id();
            $table->string('name', 200);
            $table->date('event_date');
            $table->enum('status', ["available","booked"])->default('available');
            $table->foreignId('booker_id')->nullable()->constrained();
            $table->enum('payment_status', ["pending","paid"])->default('pending');
            $table->foreignId('booker_id_id');
        });

        Schema::enableForeignKeyConstraints();
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('events');
    }
};
