<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wisata extends Model
{
    use HasFactory;
    protected $table="wisata";
    public $primaryKey = 'id_wisata';
    protected $fillable = [
        'nama_tempat','kategori','biaya','alamat','waktu','sejarah','rate','gambar'
    ]; 
    
}
