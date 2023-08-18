<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

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

    public function getFullnameAttribute() :string
    {
        return $this->getAttribute('firstname') . ' ' . $this->getAttribute('lastname');
    }

    public function getImageUrlAttribute() :string
    {
        return asset("storage/images/{$this->image}");
    }
}
