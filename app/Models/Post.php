<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $keyType = 'string';
    public $incrementing = false;

    protected $fillable = ['id', 'title', 'body', 'image', 'created_at', 'updated_at', 'user_id', 'post_type_id'];
    public function user()
    {
        return $this->belongsTo(User::class);
    }

}
