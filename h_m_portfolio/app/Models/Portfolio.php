<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Portfolio extends Model
{
    use HasFactory;

    protected $fillable = ['user_id', 'title']; //voor nu alleen title, zometeen nog content

    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
