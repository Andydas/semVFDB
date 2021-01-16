<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Movie extends Model
{
    use HasFactory;



    protected $guarded = [];
    /*    protected $fillable = [
      'nazov',
      'popis',
      'zaner',
      'img',

    ];*/

    public $timestamps = false;

    public function reviews(){
        return $this->hasMany(Review::class);
    }
}
