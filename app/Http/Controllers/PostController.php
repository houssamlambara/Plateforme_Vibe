<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


class PostController extends Controller
{
    // Afficher la vue avec tous les posts
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    // Enregistrer un nouveau post
    public function update(Request $request, Post $post)
    {
        // Validation des données
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpg,jpeg,png,gif,svg|max:2048', // Validation de l'image
        ]);

        // Si une nouvelle image est téléchargée, on la gère
        if ($request->hasFile('image')) {
            // Supprimer l'ancienne image si elle existe
            if ($post->image) {
                Storage::delete('public/' . $post->image);
            }

            // Télécharger la nouvelle image
            $imagePath = $request->file('image')->store('posts', 'public');
            $post->image = $imagePath; // Mettre à jour le chemin de l'image dans la base de données
        }

        // Mise à jour des autres informations
        $post->title = $request->title;
        $post->content = $request->content;
        $post->save(); // Sauvegarder les modifications dans la base de données

        // Rediriger avec un message de succès
        return redirect()->route('posts.index')->with('success', 'Post mis à jour avec succès!');
    }

    public function destroy(Post $post)
    {
        // Supprimer l'image associée si elle existe
        if ($post->image) {
            Storage::delete('public/' . $post->image);
        }

        // Supprimer le post de la base de données
        $post->delete();

        // Rediriger avec un message de succès
        return redirect()->route('posts.index')->with('success', 'Post supprimé avec succès!');
    }
}
