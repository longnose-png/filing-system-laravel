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
    Schema::table('login_histories', function (Blueprint $table) {
        // Add the missing user_id column and link it to the users table
        $table->foreignId('user_id')->after('id')->constrained()->onDelete('cascade');
    });
}

public function down(): void
{
    Schema::table('login_histories', function (Blueprint $table) {
        $table->dropForeign(['user_id']);
        $table->dropColumn('user_id');
    });
}

};
