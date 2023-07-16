<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DataSekolah extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function user(){
        return $this->hasOne(User::class,'datasekolah_id');
    }
    public function profilsekolah()
    {
        return $this->hasOne(ProfilSekolah::class,'datasekolah_id');
    }
}
