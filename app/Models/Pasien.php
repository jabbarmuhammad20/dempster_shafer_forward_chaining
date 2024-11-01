<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Pasien;

class Pasien extends Model
{
    use HasFactory;
    protected $table = 'pasien';
    protected $fillable = [
        'id',
        'user_id',
        'penyakit_id',
        'ktp',
        'tgl_lahir',
        'tempat_lahir',
        'alamat',
    ];

    public function User()
    {
        return $this->belongsTo(User::class, 'user_id','id');
    }
}
