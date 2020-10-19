<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = ['user_invited_id'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function skills() {
        return $this->belongsToMany(Skill::class);
    }
}
