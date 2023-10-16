<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class HeroProperty extends Model
{
    use HasFactory;
    protected $table = 'heroproperties'; 

    protected $guarded =[];
}
