<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;

class Profile extends Model
{
    use HasFactory;

    protected $fillable = [
        'firstname',
        'lastname',
        'image',
        'description'
    ];

    protected $appends = ['fullname', 'image_url'];

    public function getFullnameAttribute()
    {
        return $this->getAttribute('firstname') . ' ' . $this->getAttribute('lastname');
    }

    public function getImageUrlAttribute()
    {
        return Storage::url($this->image);
    }
}
