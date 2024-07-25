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
        Schema::table('users', function (Blueprint $table) {
              // Add company_id as a nullable foreign key after the 'role' column
            $table->unsignedBigInteger('company_id')->nullable()->after('role');
            
            // Define foreign key constraint
            $table->foreign('company_id')
                  ->references('id')
                  ->on('companies')
                  ->onDelete('set null'); // Set null on delete of the related company record
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('users', function (Blueprint $table) {
             // Drop foreign key first
            $table->dropForeign(['company_id']);
            
            // Then drop the column
            $table->dropColumn('company_id');
        });
    }
};
