<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Request_type extends Model
{
	public function petition()
    {
        return $this->belongsTo('App\Models\Petition',"request_type");
    }

    protected $guarded = [];
}
