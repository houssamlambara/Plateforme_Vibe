<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'content', 'image', 'user_id'];

    /**
     * Relation avec les commentaires
     * Un post peut avoir plusieurs commentaires
     */
    public function comments(): HasMany
    {
        return $this->hasMany(Comment::class);
    }

    /**
     * Relation avec les likes
     * Un post peut avoir plusieurs likes
     */
    public function likes(): HasMany
    {
        return $this->hasMany(Like::class);
    }

    /**
     * Vérifie si un utilisateur spécifique a liké le post
     */
    public function isLikedByUser($userId): bool
    {
        return $this->likes()->where('user_id', $userId)->exists();
    }

    /**
     * Ajoute un like au post par un utilisateur donné
     */
    public function addLike($userId)
    {
        if (!$this->isLikedByUser($userId)) {
            $this->likes()->create(['user_id' => $userId]);
        }
    }

    /**
     * Supprime un like du post pour un utilisateur donné
     */
    public function removeLike($userId)
    {
        $this->likes()->where('user_id', $userId)->delete();
    }

    /**
     * Ajoute un commentaire au post
     */
    public function addComment($userId, $content)
    {
        $this->comments()->create([
            'user_id' => $userId,
            'content' => $content,
        ]);
    }
}
