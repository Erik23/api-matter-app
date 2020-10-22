<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use App\Models\User;

class Invitation extends Model
{
    use HasFactory;

    protected $fillable = ['user_invited_id'];
    protected $appends = ['total_skills', 'evaluated_skills', 'user_invited'];

    public function user() {
        return $this->belongsTo(User::class);
    }
    public function getUserInvitedAttribute()
    {
        return User::whereId($this->user_invited_id)->first();
        // return $this->belongsTo(User::class, 'user_invited_id');
    }

    public function skills() {
        return $this->belongsToMany(Skill::class)->withPivot('score');
    }

    public function getEvaluatedSkillsAttribute() {
        return $this->skills()->count();
    }

    public function getTotalSkillsAttribute() {
        return Skill::count();
    }
}
