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
        
        $table->string('role')->after('email')->default('customer');
    });
}

/**
 * Reverse the migrations.
 */
public function down(): void
{
    Schema::table('users', function (Blueprint $table) {
        // Reverse action: drop the column to undo.
        $table->dropColumn('role');
    });
}
};
