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
        Schema::create('exam_workprocess', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('exam_id')->unsigned();
            $table->bigInteger('workprocess_id')->unsigned();
            $table->string('feedback')->nullable();
            $table->integer('score')->nullable();
            $table->timestamps();

            $table->foreign('workprocess_id')
                ->references('id')
                ->on('workprocesses')
                ->onDelete('cascade');

            $table->foreign('exam_id')
                ->references('id')
                ->on('exams')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('exam_workprocess', function (Blueprint $table) {
            $table->dropForeign(['exam_id']);
            $table->dropForeign(['workprocess_id']); // Drop the foreign key constraint
        });
        Schema::dropIfExists('exam_workprocess');
    }
};
