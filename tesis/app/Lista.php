<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Storage;
use ErrorException;

class Lista extends Model
{

	public static function read_list($filename){
		try
		{
		    $file = fopen(public_path($filename), "r");

	    	$alumnos = array();
			while ( ($data = fgetcsv($file, 500, ",")) !==FALSE)
				$alumnos[$data[0]]= $data[1];

			fclose($file);
		    return $alumnos;
		}
		catch (ErrorException $exception)
		{
		    return null;
		}
	}
}
