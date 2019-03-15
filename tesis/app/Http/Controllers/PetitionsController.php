<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\UserCreatedEmail;
use App\Models\Petition;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use DB;
use Carbon\Carbon;
use App\Lista;
use Swift_TransportException;

class PetitionsController extends Controller
{
    public function getDataUser(Request $request, $id){
      if($request->ajax()){
          $data_user=User::data_user($id);
          return response()->json($data_user);
      }
    }

    public function store(Request $request){

        //********************************************Envio falso de correo (ELIMINAR AL CORRER)****************************************************
        // Mail::fake();//Desacticar en producción

        //Validaciones necesarias para las peticiones
        $this->validate($request, [
            'name' => ['required'],
            'email' => ['required','regex:/@ula.ve$/'],
            'nationality' => ['required','regex:/^[V|E]$/'],
            'ID' => ['required','regex:/[0-9]{6,7}[0-9]$/'],
            'request_type' => ['required'],
            'area' => ['required']
        ]);


        //Se une los valores de nacionalidad e ID
        $ID=request('nationality').request('ID');

        //Carga la lista de estudiantes
        $Students = Lista::read_list(\Config::get('constants.name_of_list_students'));

        if (!array_key_exists($ID, $Students))
          return redirect('/Solicitud')->with('status-danger','La CI '. $ID. ' no aparece en la lista de usuarios, por favor comunicarse con la escuela de sistema');

        if ($Students[$ID] != request('email'))
          return redirect('/Solicitud')->with('status-danger','El email: ' . request('email').' no corresponde a la CI '. $ID);

        //Verificación de que el usuario ingresado no existe en la base de datos
        if(is_null(DB::table('users')->where('ID',$ID)->first()))

        //Creación del usuario nuevo
         $status_user = User::create([
               'name' => request('name'),
               'email' => request('email'),
               'ID' => $ID,
               'area' => request('area'),
           ]);

        else{
            User::where([
                ['ID', $ID]
              ])->update([
               'name' => request('name'),
               'email' => request('email'),
               'area' => request('area'),
            ]);
              $status_user = User::where('ID',$ID)->first();
            }

         //Creación de un ´código de verificación
        $confirmation_code = str_random(25);

        //Creación de una nueva petición
        $status_petition = Petition::create([
           'ID_user' => $ID,
           'request_type' => request('request_type'),
           'confirmation_code' => $confirmation_code
       ]);

        //Envío del correo
        try {
          Mail::to($status_user )->send(new UserCreatedEmail($status_user,$status_petition));
        } catch (Swift_TransportException $e) {
          return redirect('/')->with('status-danger','Error al enviar correo, trate más tarde o póngase en contacto con la secretaría de sistema');
        }

        return redirect('/')->with('status-check','Email envíado correctamente a: ' . $status_user->email);

    }

}
