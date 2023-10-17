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
        Schema::create('workprocesses', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('coretask_id')->unsigned();
            $table->tinyInteger('definitive');
            $table->timestamps();

            $table->foreign('coretask_id')
                ->references('id')
                ->on('coretasks')
                ->onDelete('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('workprocesses', function (Blueprint $table) {
            $table->dropForeign(['coretask_id']); // Drop the foreign key constraint
        });

            Schema::dropIfExists('workprocesses');
    }
};
