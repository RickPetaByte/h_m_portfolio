<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserText extends Model
{
    use HasFactory;

    // The attributes that are mass assignable.
    protected $fillable = [
        'user_id', // ID of the user associated with this text
        'text', // Main textual content of the user's portfolio
        'title', // Title of the portfolio
        'subtitle', // Subtitle of the portfolio
        'specialties', // Specialties related to the portfolio
        'one', // First attribute related to the portfolio
        'two', // Second attribute related to the portfolio
        'three', // Third attribute related to the portfolio
        'four', // Fourth attribute related to the portfolio
        'five', // Fifth attribute related to the portfolio
        'six', // Sixth attribute related to the portfolio
        'private', // Boolean indicating if the portfolio is private or public
        'family', // Family-related information for the portfolio
        'selected_image_alt', // Alternate text for the selected image in the portfolio
        'selected_color_image_alt', // Alternate text for the color-selected image in the portfolio
        'picture', // Path to the picture associated with the portfolio (if any)
    ];

    /**
     * Get the user that owns the UserText.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}