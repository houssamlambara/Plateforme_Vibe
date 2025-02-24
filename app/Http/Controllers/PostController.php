<?php

// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;

class PostController extends Controller
{
    // Afficher tous les posts
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

    // Enregistrer un nouveau post
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $imagePath = $request->file('image') ? $request->file('image')->store('images', 'public') : null;

        Post::create([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $imagePath,
        ]);

        return redirect()->route('posts.index')->with('success', 'Publication créée avec succès !');
    }

    // Mettre à jour un post existant
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required|string|max:255',
            'content' => 'required|string',
            'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048',
        ]);

        $post = Post::findOrFail($id);

        $imagePath = $post->image;
        if ($request->hasFile('image')) {
            if ($imagePath) {
                Storage::delete('public/' . $imagePath);
            }
            $imagePath = $request->file('image')->store('images', 'public');
        }

        $post->update([
            'title' => $request->input('title'),
            'content' => $request->input('content'),
            'image' => $imagePath,
        ]);

        return redirect()->route('posts.index')->with('success', 'Publication mise à jour avec succès !');
    }
    public function show()
    {
        $posts = Post::all(); // Récupère tous les posts
        return view('posts.index', compact('posts')); // Affiche la liste des posts
    }


    // Supprimer un post
    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->image) {
            Storage::delete('public/' . $post->image);
        }
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Publication supprimée avec succès !');
    }
}
