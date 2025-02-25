<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class FriendRequest extends Model
{
    use HasFactory;

    // Table associée à ce modèle (si elle est différente du nom du modèle en pluriel)
    protected $table = 'friend_requests';

    // Les champs qui peuvent être assignés en masse
    protected $fillable = [
        'sender_id',
        'receiver_id',
        'status'
    ];

    // Relation avec l'utilisateur qui envoie la demande
    public function sender()
    {
        return $this->belongsTo(User::class, 'sender_id');
    }


    // Relation avec l'utilisateur qui reçoit la demande
    public function receiver()
    {
        return $this->belongsTo(User::class, 'receiver_id');
    }
}
