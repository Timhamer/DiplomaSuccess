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
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('workprocess_id')->unsigned();
            $table->string('name');
            $table->tinyInteger('crucial');
            $table->string('description')->nullable();
            $table->string('zero')->nullable();
            $table->string('one')->nullable();
            $table->string('two')->nullable();
            $table->string('three')->nullable();
            $table->timestamps();

            $table->foreign('workprocess_id')
                ->references('id')
                ->on('workprocesses')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('tasks', function (Blueprint $table) {
            $table->dropForeign(['workprocess_id']); // Drop the foreign key constraint
        });

        Schema::dropIfExists('tasks');
    }
};
