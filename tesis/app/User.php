<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class User extends Model
{

	public static function data_user($id){
		return User::where('ID','=',$id)->first();
	}

    public function petitions()
    {
        return $this->hasMany('App\Models\Petition','ID_user','ID');
    }

    public function area()
    {
        return $this->hasOne('App\Models\Area',"id","area");
    }

    protected $guarded = [];

    //protected $table = 'users';
}
