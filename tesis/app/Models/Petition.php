<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Petition extends Model
{

    public function user()
    {
        return $this->belongsTo('App\User','ID_user');
    }

	public function request_type()
    {
        return $this->hasOne('App\Models\Request_type',"id","request_type");
    }

    public function status()
    {
        return $this->hasOne('App\Models\Status',"id","status");
    }


	protected $casts = [
        'collections' => 'array'
    ];

    protected $guarded = [];

}
