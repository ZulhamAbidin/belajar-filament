<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class komentar extends Model
{
    use SoftDeletes;
    protected $table = 'komentar';
    protected $fillable = ['komentar', 'postingan_id', 'user_id'];
    use HasFactory;

    // Relasi Komentar ke postingan
    // Setiap Komentar terkait dengan satu postingan, jadi kita menggunakan belongsTo
    public function postingan()
    {
        return $this->belongsTo(postingan::class);
    }

    // Relasi Komentar ke User
    // Setiap Komentar dibuat oleh satu User, jadi kita menggunakan belongsTo
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}