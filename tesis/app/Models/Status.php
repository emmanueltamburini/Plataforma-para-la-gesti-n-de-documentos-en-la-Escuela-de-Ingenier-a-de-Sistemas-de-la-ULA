<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Status extends Model
{
	public function petition()
    {
        return $this->belongsTo('App\Models\Petition','status');
    }

    protected $guarded = [];
}
