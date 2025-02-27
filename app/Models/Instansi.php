<?php

namespace App\Models;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Instansi extends Model
{
    use HasFactory;
    protected $table = 'instansis';
    protected $primaryKey = 'id_instansi';
    protected $fillable = ['nama_instansi'];
    public function users()
    {
        return $this->hasMany(User::class, 'instansi_id');
    }
}