<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'cover_pic',
        'content',
        'type_id'
    ];

    protected $hidden = ['cover_pic'];

    /**
     * The accessors to append to the model's array form.
     * 
     * @var array
     */
    protected $appends = ['full_img_path'];

    public function getFullImgPathAttribute()
    {
        $fullPath = null;

        if ($this->cover_pic) {
            $fullPath = asset('storage/' . $this->cover_pic);
        }

        return $fullPath;
    }

    public function type()
    {
        return $this->belongsTo(Type::class);
    }

    public function technologies()
    {
        return $this->belongsToMany(Technology::class);
    }
}
