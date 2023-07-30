<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Achado extends Model
{
    use HasFactory;
    public $timestamps = false;
    public $table = 'achados';
}
