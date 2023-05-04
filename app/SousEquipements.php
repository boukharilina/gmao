<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class SousEquipements extends Model
{
    /**
     * Get the equipement that owns the SousEquipements
     *
     * @return \Illuminate\DatabEquipemntEloquent\Req_idlongsTo
     */
    public function equipement()
    {
        return $this->belongsTo(Equipement::class);
    }
}    
 