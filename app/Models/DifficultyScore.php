<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DifficultyScore extends Model
{
    use HasFactory;

    public $timestamps = false;

    protected $fillable = ['subject_id','user_id','score'];
}
