<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::create('friends', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade');  // Utilisateur qui envoie la demande
            $table->foreignId('friend_id')->constrained('users')->onDelete('cascade'); // Utilisateur qui reçoit la demande
            $table->enum('status', ['pending', 'accepted', 'declined'])->default('pending');  // Statut de la demande
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('friends');
    }
};
