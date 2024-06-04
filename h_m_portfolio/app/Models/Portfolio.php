<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'subtitle', 'one', 'two', 'three', 'four', 'five', 'six',
        'about', 'private', 'selected_image_alt', 'selected_color_image_alt',
        'picture', 'user_id'
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
