<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;

    // Indique les champs qui peuvent être assignés en masse
    protected $fillable = ['title', 'content'];
}
