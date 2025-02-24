<?php

namespace App\Http\Controllers;

use App\Models\Post;
use Illuminate\Http\Request;

class PostController extends Controller
{
    // Afficher le formulaire d'ajout de post
    public function create()
    {
        return view('posts.create');
    }


    // Enregistrer un post dans la base de données
    public function store(Request $request)
    {
        // dd($request->all()); 

        // Validation des données
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            
        ]);

        // Créer un nouveau post
        Post::create([
            'title' => $request->title,
            'content' => $request->content,
        ]);

        // Rediriger vers la page des posts après la création
        return redirect()->route('posts.index');
    }

    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        $post->delete();

        return redirect()->route('posts.index');
    }

    // Afficher tous les posts
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }
}
