<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Penyakit;

class Gejala extends Model
{
    use HasFactory;
    protected $table = 'gejala';
    protected $fillable = [
        'id',
        'penyakit_id',
        'kode',
        'deskripsi',
        'blf',
    ];

    public function penyakit()
    {
        return $this->belongsTo(Penyakit::class, 'penyakit_id');
    }
}
