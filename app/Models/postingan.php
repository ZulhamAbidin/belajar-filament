<?php

namespace App\Models;

use Illuminate\Support\Str;
use Spatie\Sluggable\HasSlug;
use Spatie\Sluggable\SlugOptions;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class postingan extends Model
{
    use SoftDeletes;
    protected $table = 'postingan';
    protected $fillable = ['judul', 'konten', 'kategori_id', 'sampul', 'published'];
    protected $guarded = ['slug'];
    use HasSlug;
    use HasFactory;

    protected $casts = [
        'published' => 'boolean',
    ];

    // Relasi Post ke kategori Setiap Post memiliki satu kategori, jadi kita menggunakan belongsTo
    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'kategori_id');
    }

    // Relasi Post ke Comment Setiap Post dapat memiliki banyak Comment, jadi kita menggunakan hasMany
    public function komentar()
    {
        return $this->hasMany(komentar::class);
    }

    // Untuk membuat dan mengelola slug secara otomatis berdasarkan judul
    public function getSlugOptions() : SlugOptions
    {
        return SlugOptions::create()
            ->generateSlugsFrom('judul')
            ->saveSlugsTo('slug');
    }

    // public function kategori()
    // {
    //     return $this->belongsTo(kategori::class);
    // }
}