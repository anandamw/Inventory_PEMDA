<?php

namespace App\Models;

use App\Models\Repair;
use Illuminate\Database\Eloquent\Model;

class RepairTeam extends Model
{

    protected $guarded = [
        'id',

    ];

    protected $table = 'repair_teams';

    public function repair()
    {
        return $this->belongsTo(Repair::class, 'repair_id', 'id_repair');
    }

    
}
