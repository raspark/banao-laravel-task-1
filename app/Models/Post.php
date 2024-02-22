<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Post extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'title',
        'slug',
        'featured_image',
        'description',
        'meta_description',
        'status',
        'created_by',
        'updated_by',
        'deleted_by',
        'published_at'
    ];

    protected $dates = ['published_at'];
}
