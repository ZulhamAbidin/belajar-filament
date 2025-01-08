<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class postingan extends Model
{
    use SoftDeletes;
    protected $table = 'postingan';
    protected $fillable = ['judul', 'konten', 'kategori_id', 'sampul', 'published'];
    protected $guarded = ['slug'];
    use HasFactory;


    // Relasi Post ke kategori
    // Setiap Post memiliki satu kategori, jadi kita menggunakan belongsTo
    public function kategori()
    {
        return $this->belongsTo(kategori::class, 'kategori_id');
    }

    // public function kategori()
    // {
    //     return $this->belongsTo(kategori::class);
    // }


    // Relasi Post ke Comment
    // Setiap Post dapat memiliki banyak Comment, jadi kita menggunakan hasMany
    public function komentar()
    {
        return $this->hasMany(komentar::class);
    }

    // Untuk membuat dan mengelola slug secara otomatis berdasarkan judul
    protected static function booted()
    {
        static::creating(function ($postingan) {
            $postingan->slug = Str::slug($postingan->judul);
        });
    }
}