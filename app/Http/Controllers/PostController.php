<?php

// app/Http/Controllers/PostController.php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Post;
use Illuminate\Support\Facades\Storage;
use App\Models\Comment;

class PostController extends Controller
{
    public function index()
    {
        $posts = Post::all();
        return view('posts.index', compact('posts'));
    }

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
    public function show($id)
    {
        $post = Post::with('comments')->findOrFail($id);
        return view('posts.show', compact('post'));
    }



    public function destroy($id)
    {
        $post = Post::findOrFail($id);
        if ($post->image) {
            Storage::delete('public/' . $post->image);
        }
        $post->delete();

        return redirect()->route('posts.index')->with('success', 'Publication supprimée avec succès !');
    }

    public function toggleLike($id)
    {
        $post = Post::findOrFail($id);
        $user = auth()->user();

        // Vérifie si l'utilisateur a déjà liké ce post
        $like = $post->likes()->where('user_id', $user->id)->first();

        if ($like) {
            // Si un like existe, on le supprime (Dislike)
            $like->delete();
            return back()->with('success', 'Like retiré avec succès !');
        } else {
            // Sinon, on ajoute un like
            $post->likes()->create(['user_id' => $user->id]);
            return back()->with('success', 'Post liké avec succès !');
        }
    }

    public function comment(Request $request, $id)
    {
        $post = Post::findOrFail($id);
        $user = auth()->user();

        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        $post->comments()->create([
            'user_id' => $user->id,
            'content' => $request->input('content'),
        ]);

        return back()->with('success', 'Commentaire ajouté avec succès !');
    }

    public function editComment($id)
    {
        $comment = Comment::findOrFail($id);
        $user = auth()->user();

        return view('comments.edit', compact('comment'));
    }

    public function updateComment(Request $request, $id)
    {
        $request->validate([
            'content' => 'required|string|max:255',
        ]);

        // Trouver le commentaire et vérifier s'il existe
        $comment = Comment::findOrFail($id);

        // Mettre à jour le contenu du commentaire
        $comment->update([
            'content' => $request->input('content'),
        ]);

        return back()->with('success', 'Commentaire mis à jour avec succès !');
    }


    public function deleteComment($id)
    {
        $comment = Comment::findOrFail($id);
        $user = auth()->user();

        if ($comment->user_id !== $user->id) {
            return back()->with('error', 'Vous ne pouvez pas supprimer ce commentaire.');
        }

        $comment->delete();

        return back()->with('success', 'Commentaire supprimé avec succès !');
    }
}
