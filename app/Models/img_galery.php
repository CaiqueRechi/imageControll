<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class img_galery extends Model
{
    protected $fillable = ['id','img'];
    use HasFactory;
}
