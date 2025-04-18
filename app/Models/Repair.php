<?php

namespace App\Models;

use App\Models\User;
use App\Models\RepairTeam;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Repair extends Model
{
    use HasFactory;

    // Penting! Karena primary key bukan 'id', Laravel perlu tahu ini.
    protected $primaryKey = 'id_repair';

    protected $fillable = [
        'user_id',
        'admin_id',
        'team_id',
        'repair',
        'scheduled_date',
        'status'
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id'); // Pastikan 'user_id' sesuai dengan kolom di tabel
    }


    public function admin()
    {
        return $this->belongsTo(User::class, 'admin_id');
    }

    public function teams()
    {
        return $this->belongsToMany(User::class, 'repair_teams', 'repair_id', 'user_id');
    }


    public function repairTeam()
    {
        return $this->hasOne(RepairTeam::class, 'repair_id', 'id_repair');
    }
}
