<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

<<<<<<< HEAD
    protected $fillable = [
        'user_id', 
        'title', 
        'subtitle', 
        'one', 
        'two', 
        'three', 
        'four', 
        'five', 
        'six',
        'about', 
        'private', 
        'selected_image_alt', 
        'selected_color_image_alt',
        'picture', 
    ];
=======
    protected $fillable = ['user_id', 'title']; //voor nu alleen title, zometeen nog content
>>>>>>> debcda734c4dfb4f754000f6edbded4635ba9936

    public function user()
    {
        return $this->belongsTo(User::class);
    }
<<<<<<< HEAD
}
=======
}
>>>>>>> debcda734c4dfb4f754000f6edbded4635ba9936
