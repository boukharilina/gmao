<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Equipement extends Model
{
    
   
    /**
     * Get all of the comments for the Equipement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function sousEquipements(): HasMany
    {
        return $this->hasMany(SousEquipements::class); 
    }

 
    /**
     * Get all of the comments for the Equipement
     *
     * @return \Illuminate\Database\Eloquent\Relations\HasMany
     */
    public function accessoires(): HasMany
    {
        return $this->hasMany(Accessoire::class);
    }

    /** 
     * Get the modalite that owns the Equipement
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function modalite(): BelongsTo
    {
        return $this->belongsTo(Modalite::class);
    }
  }

  

