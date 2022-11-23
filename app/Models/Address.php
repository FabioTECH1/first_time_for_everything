<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Spiritix\LadaCache\Database\LadaCacheTrait;

class Address extends Model
{
    use HasFactory;
    // use LadaCacheTrait;
    protected $guarded = ['id'];

    function user()
    {
        return $this->belongsTo(User::class);
    }
}