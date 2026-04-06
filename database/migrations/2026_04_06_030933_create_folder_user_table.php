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
       Schema::create('folder_user', function (Blueprint $table) {
        $table->id();
           // This links to the folder being shared
        $table->foreignId('folder_id')->constrained()->onDelete('cascade');

           // This links to the user who is RECEIVING the share
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        
        $table->timestamps();
    });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('folder_user');
    }
};
