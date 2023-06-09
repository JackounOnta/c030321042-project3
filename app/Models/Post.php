<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    use HasFactory;
    protected $fillable = [
        'title', 'slug', 'category_id', 'user_id', 'content', 'image',
        'description'
    ];

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function comments()
    {
        return $this->hasMany(Comments::class);
    }

    public function image()
    {
        return Attribute::make(
            get: fn ($value)=>asset('/storage/posts/'.$value),
        );
    }

    public function createdAt(): Attribute
    {
        return Attribute::make(
            get:fn($value)=>\Carbon\Carbon::locale('id')->parse($value)->translatedFormat('l,d F Y'),
        );
    }

    public function updateAt(): Attribute
    {
        return Attribute::make(
            get:fn($value)=>\Carbon\Carbon::local('id')->parse($value)->translatedFormat('l, d F Y'),
        );
    }
}
