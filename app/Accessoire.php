<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Accessoire extends Model
{
    
    /**
     * Get the modalite that owns the Equipement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function equipement(): BelongsTo
    {
        return $this->belongsTo(equipement::class);
    }
}
