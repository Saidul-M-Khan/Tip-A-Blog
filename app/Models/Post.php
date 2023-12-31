<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Post extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title', 'content', 'image', 'created_at'];

    public $timestamps = true;

    function users():BelongsTo{
        return $this->belongsTo(User::class);
    }

    function comments():HasMany{
        return $this->hasMany(Comment::class);
    }

    function tags():BelongsToMany{
        return $this->belongsToMany(Tag::class, 'post_tags');
    }
}
