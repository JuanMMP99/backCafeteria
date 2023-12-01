<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class product extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'image',
        'price',
        'desc',
        'category_id',
    ];

    public function categories(){
        return $this->belongsTo(category::class);
    }
}
