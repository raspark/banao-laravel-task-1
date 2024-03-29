<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'task',
        'status',
        'user_id'
    ];


    // relationship between the Task and User models
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // Accessor for the created_at attribute
    public function getCreatedAtHumanAttribute()
    {
        return \Carbon\Carbon::parse($this->created_at)->diffForHumans();
    }

}
