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
        Schema::create('grades', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('workprocess_id')->unsigned();
            $table->integer('points');
            $table->integer('grades');
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
        Schema::table('grades', function (Blueprint $table) {
            $table->dropForeign(['workprocess_id']); // Drop the foreign key constraint
        });
        Schema::dropIfExists('grades');
    }
};
