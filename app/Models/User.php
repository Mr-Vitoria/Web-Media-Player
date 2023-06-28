<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Music extends Model
{
    protected $primaryKey = 'id';
    protected $table = 'users';
    protected $filable = ['login','email','password','imagepath'];

}
