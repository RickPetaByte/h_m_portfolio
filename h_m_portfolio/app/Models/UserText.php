<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserText extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id', 
        'text', 
        'title', 
        'subtitle', 
        'one', 
        'two', 
        'three', 
        'four', 
        'five', 
        'six', 
        'private', 
        'selected_image_alt', 
        'selected_color_image_alt',
        'picture'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}