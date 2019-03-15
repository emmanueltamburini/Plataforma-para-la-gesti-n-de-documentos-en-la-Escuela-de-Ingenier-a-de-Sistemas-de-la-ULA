<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\UserCreatedEmail;
use App\Mail\PetitionsCreatedEmail;
use App\Models\Petition;
use Illuminate\Support\Facades\Storage;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use DB;
use Swift_TransportException;

class SearchController extends Controller
{
	//Controlador para buscar la cédula del usuario
    public function search(Request $request){
        //Validaciones necesarias para los modelos
        $this->validate($request, [
            'nationality' => ['required','regex:/^[V|E]$/'],
            'ID' => ['required','regex:/[0-9]{6,7}[0-9]$/']
        ]);

        //Se une los valores de nacionalidad e ID
        $ID=request('nationality').request('ID');

		return redirect()->route('search.found',[
			'ID'   => $ID,
		]);
    }

    //Controlador que consigue la CI del usuario
    public function find($ID){

    	//Buscan todas las peticiones que tiene la CI del usuario
        $petitions= Petition::where('ID_user',$ID)->get();

        if($petitions->isEmpty())
            return view('search.found')->with([
            'petitions' => null,
            'status_danger' => "Usuario con ".$ID." no encontrado",
            'status_check' => null,
        ]);

        //Regresa la vista con las peticiones
        return view('search.found')->with([
        	'petitions' => $petitions,
            'status_check' => "Usuario con ".$ID." encontrado con éxito",
            'status_danger' => null,
        ]);
    }

    public function send($ID)
    {
        $petitions= Petition::where('ID_user',$ID)->get();
        try {
          Mail::to($petitions->first()->user()->get()[0]->email)->send(new PetitionsCreatedEmail($petitions));
        } catch (Swift_TransportException $e) {
          return redirect('/')->with('status-danger','Error al enviar correo, trate más tarde o póngase en contacto con la secretaría de sistema');
        }
        return view('search.found')->with([
            'petitions' => $petitions,
            'status_check' => "Correo enviado con éxito al correo asociado a la cédula ".$petitions->first()->ID_user,
            'status_danger' => null,
        ]);
    }
}
