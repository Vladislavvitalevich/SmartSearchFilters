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
        Schema::create('issues', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger('assigner_id');
            $table->foreign('assigner_id')->references('id')->on('users');
            
            $table->unsignedBigInteger('assignee_id');
            $table->foreign('assignee_id')->references('id')->on('users');

            $table->string('title', 255);
            $table->text('description');
            $table->enum('priority', [1,2,3]);
            $table->enum('status_id', ["Backlog", "Todo", "In progress", "In testing", "Done"]);
            $table->enum('story_points', [1,2,3,4,5,6,7,8,9,10]);
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('issues');
    }
};
