<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Gejala;

class Penyakit extends Model
{
    use HasFactory;
    protected $table = 'penyakit';
    protected $fillable = [
        'id',
        'kode',
        'nama_penyakit',
    ];

    public function Gejala()
    {
        return $this->hasMany(Gejala::class, 'id','penyakit_id');
    }
}
