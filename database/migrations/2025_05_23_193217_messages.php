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
        Schema::create('messages', function (Blueprint $table) {
            $table->id();

            $table->bigInteger('from_id')->unsigned();
            $table->foreign('from_id')
                ->references('id')->on('users');
            $table->bigInteger('to_id')->unsigned();
            $table->foreign('to_id')
                ->references('id')->on('users');
            $table->string('message');
            $table->string('type')->default('text');
            $table->enum('status', ['pending', 'sent', 'read'])->default('pending');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('messages');
    }
};
