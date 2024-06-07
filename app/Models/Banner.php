<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Banner extends Model
{
    protected $fillable = [
        'type', 'heading', 'title', 'description', 'link', 'alt', 'sort', 'status', 'banner_image', 'banner_image_dark'
    ];
}
