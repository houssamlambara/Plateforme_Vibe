<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    // Envoyer une demande d'ami
    public function sendRequest($friendId)
    {
        $user = auth()->user();

        // Vérifie si la demande n'a pas déjà été envoyée ou acceptée
        if ($user->id === $friendId || $user->friends()->where('friend_id', $friendId)->exists()) {
            return redirect()->back()->with('error', 'Demande déjà envoyée ou déjà ami.');
        }

        // Envoie la demande d'ami
        $user->friendRequests()->attach($friendId, ['status' => 'pending']);

        return redirect()->back()->with('success', 'Demande d\'ami envoyée.');
    }

    // Accepter ou refuser une demande d'ami
    public function respondToRequest($friendId, $action)
    {
        $user = auth()->user();

        // Trouve la demande
        $friendRequest = $user->friendRequests()->where('friend_id', $friendId)->first();

        if (!$friendRequest) {
            return redirect()->back()->with('error', 'Aucune demande trouvée.');
        }

        if ($action === 'accept') {
            $friendRequest->pivot->status = 'accepted';
            $friendRequest->pivot->save();
        } elseif ($action === 'decline') {
            $friendRequest->pivot->status = 'declined';
            $friendRequest->pivot->save();
        }

        return redirect()->back()->with('success', 'Demande traitée.');
    }

    // Afficher la liste des amis
    public function showFriends()
    {
        $user = auth()->user();
        $friends = $user->friends;

        return view('friends.index', compact('friends'));
    }
}
