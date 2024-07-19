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
        Schema::create('equipment_allocations', function (Blueprint $table) {
            $table->id();
            $table->uuid('uid')->index();
            $table->unsignedBigInteger('user_id')->index();
            $table->unsignedBigInteger('equipment_id')->index();
            $table->string('date_of_allocation');
            $table->string('return_date')->nullable();
            $table->string('allocation_equipment_status');
            $table->string('return_equipment_status')->nullable();
            $table->string('notes')->nullable();

            $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
            $table->foreign('equipment_id')->references('id')->on('equipments')->onDelete('cascade');

            $table->softDeletes();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('equipment_allocations');
    }
};
