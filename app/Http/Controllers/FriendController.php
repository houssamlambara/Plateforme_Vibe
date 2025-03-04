<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\FriendRequest;
use Illuminate\Http\Request;

class FriendController extends Controller
{
    public function index()
    {
        $users = User::all();

        // Récupère les demandes d'amis reçues par l'utilisateur connecté avec l'expéditeur
        $pendingRequests = auth()->user()->receivedRequests()->with('sender')->where('status', 'pending')->get();

        return view('friends.index', compact('users', 'pendingRequests'));
    }

    public function sendRequest($userId)
    {
        $user = User::findOrFail($userId);

        // Vérifie si une demande d'ami existe déjà entre l'utilisateur connecté et l'utilisateur cible
        $existingRequest = auth()->user()->sentRequests()->where('receiver_id', $user->id)->where('status', 'pending')->first();

        // Si aucune demande n'existe, crée une nouvelle demande
        if (!$existingRequest) {
            auth()->user()->sentRequests()->create([
                'receiver_id' => $user->id,
                'status' => 'pending'
            ]);
        } else {
            return redirect()->route('friends.index')->with('error', 'Vous avez déjà une demande en attente.');
        }

        return redirect()->route('friends.index');
    }

    public function acceptRequest($requestId)
    {
        $request = FriendRequest::findOrFail($requestId);
        $request->status = 'accepted';
        $request->save();

        return redirect()->route('friends.index');
    }

    public function declineRequest($requestId)
    {
        $request = FriendRequest::findOrFail($requestId);
        $request->status = 'declined';
        $request->save();

        return redirect()->route('friends.index');
    }
    public function cancelSentRequests()
    {
        // Mettre à jour toutes les demandes envoyées pour les marquer comme "annulées"
        auth()->user()->sentRequests()->update(['status' => 'cancelled']);

        return redirect()->route('friends.index')->with('success', 'Toutes les demandes envoyées ont été annulées.');
    }
}
