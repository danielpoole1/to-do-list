<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void {
        Schema::create('tasks', function (Blueprint $table) {
            /**
             * Future features
             *
             * An indexed user_id column to link a task to a user (also include user management functionality)
             * Task priority/sorting capability
             * Description for longer notes
             * Task due_date if a task has a deadline
             */

            $table->id();
            $table->string('name');
            $table->boolean('completed')->default(false); // If filtering by this later on we could add an index to improve performance.
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void {
        Schema::dropIfExists('tasks');
    }
};
