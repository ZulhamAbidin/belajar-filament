<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class kategori extends Model
{
    use SoftDeletes;
    protected $table = 'kategori';
    protected $fillable = ['nama'];
    use HasFactory;

    // Relasi kategori ke Post
    // Setiap kategori dapat memiliki banyak postingan, jadi kita menggunakan hasMany
    public function postingan()
    {
        return $this->hasMany(postingan::class);
    }
}