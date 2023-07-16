<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Concerns\HasUuids;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Laporan extends Model
{
    use HasFactory,HasUuids;
    protected $guarded=['id'];
    public function datasekolah(){
        return $this->belongsTo(DataSekolah::class);
    }
    public function lampiran(){
        return $this->hasOne(Lampiran::class);
    }
    public function nosurat(){
        return $this->hasOne(NoSurat::class);
    }
    public function ceksurat(){
        return $this->hasOne(NoSurat::class)->exists();
    }

}
