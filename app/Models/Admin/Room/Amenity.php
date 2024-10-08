<?php

namespace App\Models\Admin\Room;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Amenity extends Model
{
    use HasFactory;
    protected $table = 'amenities';
    protected $fillable = [
        'name','description','image_url', 
    ];
}
