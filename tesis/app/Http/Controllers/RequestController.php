<?php

namespace App\Http\Controllers;

use App\User;
use App\Mail\UserCreatedEmail;
use App\Models\Petition;
use Illuminate\Support\Facades\Storage;
use Illuminate\Http\File;
use http\Env\Response;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Mail;
use Illuminate\Support\Facades\Crypt;
use LogicException;
use Illuminate\Contracts\Encryption\DecryptException;
use DB;
use Carbon\Carbon;

class RequestController extends Controller
{

    //Controlador para la verificiación de las peticiones
    public function verify($ID, $code)
    {
        //Prueba que se pueda descifrar el valor
        try {
            Crypt::decryptString($ID);
            Crypt::decryptString($code);
        } catch (DecryptException $e) {
            return redirect('/')->with('status-danger', 'La petición solicitada no existe en el sistema');
        }

        //Se Busca la petición
        $Petition = Petition::where([
          ['id', Crypt::decryptString($ID)],
          ['confirmation_code', Crypt::decryptString($code)]
        ])->first();

        //Se declara una variable para manejar el tiempo
        $date = Carbon::now();

        //De no conesguirse se redirige a inicio
        if (!$Petition)
            return redirect('/')->with('status-danger', 'La petición solicitada no existe en el sistema');

        //Si la petición se confirma fuera de la hora esperada
        if ($Petition->created_at < $date->subHour(\Config::get('constants.hour'))->subMinute(\Config::get('constants.minute'))->subSecond(\Config::get('constants.second'))){
            Petition::where([
              ['confirmation_code', $Petition->confirmation_code],
              ['id', $Petition->id]
            ])->update([
              'confirmed' => false,
              'info' => 'La petición ha caducado, se recomienda realizar una nueva',
              'confirmation_code' => null,
              'status' => 1,
            ]);
            return redirect('/')->with('status-danger', 'La petición solicitada a caducado');
          }

        //Al conseguirse se elimina el código de verificación y se pasa a la página correspondiente
        Petition::where([
          ['confirmation_code', $Petition->confirmation_code],
          ['id', $Petition->id]
        ])->update([
          'confirmed' => true,
          'info' => 'Esperando por recaudos',
        ]);

        switch ($Petition->request_type){
            case 1:
              return redirect()->route('request.parallel',[
                  'ID'   =>  $ID,
                  'code' =>  $code,
              ])->with([
                  'ID'   =>  $ID,
                  'code' =>  $code,
              ]);
              break;

            case 2:
              return redirect()->route('request.schedule_collision',[
                  'ID'   =>  $ID,
                  'code' =>  $code,
              ])->with([
                  'ID'   =>  $ID,
                  'code' =>  $code,
              ]);
              break;

            case 3:
              return redirect()->route('request.excess_credit_units',[
                  'ID'   =>  $ID,
                  'code' =>  $code,
              ])->with([
                  'ID'   =>  $ID,
                  'code' =>  $code,
              ]);
              break;

            case 4:
              return redirect()->route('request.graduation_project',[
                  'ID'   =>  $ID,
                  'code' =>  $code,
              ])->with([
                  'ID'   =>  $ID,
                  'code' =>  $code,
              ]);
              break;

        }
    }

    //Controlador para formulario de materias en paralelo
    public function uploadParallel($ID, $code, request $request){

        //Prueba que se pueda descifrar el valor
        try {
            Crypt::decryptString($ID);
            Crypt::decryptString($code);
        } catch (DecryptException $e) {
            return redirect('/')->with('status-danger', 'La petición solicitada no existe en el sistema');
        }

        //Se verifica el contenido de la request
        $this->validate($request, [
            'subjects_selection' => ['required','mimes:pdf'],
            'proof_notes' => ['required','mimes:pdf'],
            'reason_letter' => ['required','mimes:pdf'],
        ]);

        //Se Busca la petición
        $Petition = Petition::where([
          ['id', Crypt::decryptString($ID)],
          ['confirmation_code', Crypt::decryptString($code)]
        ])->first();

        try {
          //Si la solicitud no se consigue
          if (! $Petition or !$Petition->confirmed)
            return redirect('/')->with('status-danger', 'La petición no existe o no está confirmada aún');

          //Verifica que la request tenga un archivo
          if($request->hasFile('subjects_selection') and $request->hasFile('proof_notes') and $request->hasFile('reason_letter')){
            //Se guarda el archivo en una variable, se crea nombre unívoco para el archivo y Se guarda archivo en el disco correspondiente
            //Selección de materias
            $file_subjects_selection = $request->file('subjects_selection');
            $name_subjects_selection = "ID_".$Petition->id."_CI_".$Petition->ID_user."_seleccion_de_materias.pdf";
            $path_subjects_selection = Storage::disk(\Config::get('constants.Disco'))->putFileAs(
                //*******************Se debe modificar el archivo config al para indicar el disco donde se guardaran los archivos*********************
                'subjects_selection', $file_subjects_selection, $name_subjects_selection
            );

            //constancia de notas
            $file_proof_notes = $request->file('proof_notes');
            $name_proof_notes = "ID_".$Petition->id."_CI_".$Petition->ID_user."_constancia_de_notas.pdf";
            $path_proof_notes = Storage::disk(\Config::get('constants.Disco'))->putFileAs(
                //*******************Se debe modificar el archivo config al para indicar el disco donde se guardaran los archivos*********************
                'proof_notes', $file_proof_notes, $name_proof_notes
            );

            //Selección de materias
            $file_reason_letter = $request->file('reason_letter');
            $name_reason_letter = "ID_".$Petition->id."_CI_".$Petition->ID_user."_carta_de_motivo.pdf";
            $path_reason_letter = Storage::disk(\Config::get('constants.Disco'))->putFileAs(
                //*******************Se debe modificar el archivo config al para indicar el disco donde se guardaran los archivos*********************
                'reason_letter', $file_reason_letter, $name_reason_letter
            );

            //Se actualiza la petición correspondiente
            Petition::where([
              ['confirmation_code', $Petition->confirmation_code],
              ['id', $Petition->id]
            ])->update([
              'collections' => '[
                  {"subjects_selection":"'.$path_subjects_selection.'"},
                  {"proof_notes":"'.$path_proof_notes.'"},
                  {"reason_letter":"'.$path_reason_letter.'"}
                ]',
                'confirmation_code' =>null,
                'info' => 'Esperando por respuesta',
            ]);
            return redirect('/')->with('status-check', 'Petición completada con éxito');
          }
        }
        catch (LogicException $e) {
            //Se actualiza la petición correspondiente
            Petition::where([
              ['confirmation_code', $Petition->confirmation_code],
              ['id', $Petition->id]
            ])->update([
                'info' => 'Error al tratar de procesar la petición, intente más tarde o trate de ponerse en contacto con la escuela de sistema',
            ]);
            return redirect('/')->with('status-danger', 'Error al tratar de procesar la petición, intente más tarde o trate de ponerse en contacto con la escuela de sistema');
        }
    }

    //Controlador para formulario de colisión de horarios
    public function uploadSchedule_collision($ID, $code, request $request){

        //Prueba que se pueda descifrar el valor
        try {
            Crypt::decryptString($ID);
            Crypt::decryptString($code);
        } catch (DecryptException $e) {
            return redirect('/')->with('status-danger', 'La petición solicitada no existe en el sistema');
        }

        //Se verifica el contenido de la request
        $this->validate($request, [
            'subjects_selection' => ['required','mimes:pdf'],
            'proof_notes' => ['required','mimes:pdf'],
            'reason_letter' => ['required','mimes:pdf'],
            'currently_schedule' => ['required','mimes:pdf'],
        ]);

        //Se Busca la petición
        $Petition = Petition::where([
          ['id', Crypt::decryptString($ID)],
          ['confirmation_code', Crypt::decryptString($code)]
        ])->first();

        try{
        //Si la solicitud no se consigue
        if (! $Petition or !$Petition->confirmed)
          return redirect('/')->with('status-danger', 'La petición no existe o no está confirmada aún');

          //Verifica que la request tenga un archivo
          if($request->hasFile('subjects_selection') and $request->hasFile('proof_notes')
           and $request->hasFile('reason_letter') and $request->hasFile('currently_schedule')){
            //Se guarda el archivo en una variable, se crea nombre unívoco para el archivo y Se guarda archivo en el disco correspondiente
            //Selección de materias
            $file_subjects_selection = $request->file('subjects_selection');
            $name_subjects_selection = "ID_".$Petition->id."_CI_".$Petition->ID_user."_seleccion_de_materias.pdf";
            $path_subjects_selection = Storage::disk(\Config::get('constants.Disco'))->putFileAs(
                //*******************Se debe modificar el archivo config al para indicar el disco donde se guardaran los archivos*********************
                'subjects_selection', $file_subjects_selection, $name_subjects_selection
            );

            //constancia de notas
            $file_proof_notes = $request->file('proof_notes');
            $name_proof_notes = "ID_".$Petition->id."_CI_".$Petition->ID_user."_constancia_de_notas.pdf";
            $path_proof_notes = Storage::disk(\Config::get('constants.Disco'))->putFileAs(
                //*******************Se debe modificar el archivo config al para indicar el disco donde se guardaran los archivos*********************
                'proof_notes', $file_proof_notes, $name_proof_notes
            );

            //Selección de materias
            $file_reason_letter = $request->file('reason_letter');
            $name_reason_letter = "ID_".$Petition->id."_CI_".$Petition->ID_user."_carta_de_motivo.pdf";
            $path_reason_letter = Storage::disk(\Config::get('constants.Disco'))->putFileAs(
                //*******************Se debe modificar el archivo config al para indicar el disco donde se guardaran los archivos*********************
                'reason_letter', $file_reason_letter, $name_reason_letter
            );

                      //Selección de materias
            $file_currently_schedule = $request->file('currently_schedule');
            $name_currently_schedule = "ID_".$Petition->id."_CI_".$Petition->ID_user."_horario_actual.pdf";
            $path_currently_schedule = Storage::disk(\Config::get('constants.Disco'))->putFileAs(
                //*******************Se debe modificar el archivo config al para indicar el disco donde se guardaran los archivos*********************
                'currently_schedule', $file_reason_letter, $name_reason_letter
            );

          //Se actualiza la petición correspondiente
          Petition::where([
            ['confirmation_code', $Petition->confirmation_code],
            ['id', $Petition->id]
          ])->update([
            'collections' => '[
                {"subjects_selection":"'.$path_subjects_selection.'"},
                {"proof_notes":"'.$path_proof_notes.'"},
                {"reason_letter":"'.$path_reason_letter.'"},
                {"currently_schedule":"'.$path_currently_schedule.'"}
              ]',
              'confirmation_code' =>null,
              'info' => 'Esperando por respuesta',
          ]);

          }
          return redirect('/')->with('status-check', 'Petición completada con éxito');
        }
        catch (LogicException $e) {
            //Se actualiza la petición correspondiente
            Petition::where([
              ['confirmation_code', $Petition->confirmation_code],
              ['id', $Petition->id]
            ])->update([
                'info' => 'Error al tratar de procesar la petición, intente más tarde o trate de ponerse en contacto con la escuela de sistema',
            ]);
            return redirect('/')->with('status-danger', 'Error al tratar de procesar la petición, intente más tarde o trate de ponerse en contacto con la escuela de sistema');
        }
    }

    //Controlador para formulario de Exceso de unidades de crédito
    public function uploadExcess_credit_units($ID, $code, request $request){

        //Prueba que se pueda descifrar el valor
        try {
            Crypt::decryptString($ID);
            Crypt::decryptString($code);
        } catch (DecryptException $e) {
            return redirect('/')->with('status-danger', 'La petición solicitada no existe en el sistema');
        }

        //Se verifica el contenido de la request
        $this->validate($request, [
            'subjects_selection' => ['required','mimes:pdf'],
            'proof_notes' => ['required','mimes:pdf'],
            'reason_letter' => ['required','mimes:pdf'],
        ]);

        //Se Busca la petición
        $Petition = Petition::where([
          ['id', Crypt::decryptString($ID)],
          ['confirmation_code', Crypt::decryptString($code)]
        ])->first();

        try{
          //Si la solicitud no se consigue
          if (! $Petition or !$Petition->confirmed)
            return redirect('/')->with('status-danger', 'La petición no existe o no está confirmada aún');

          //Verifica que la request tenga un archivo
          if($request->hasFile('subjects_selection') and $request->hasFile('proof_notes') and $request->hasFile('reason_letter')){
            //Se guarda el archivo en una variable, se crea nombre unívoco para el archivo y Se guarda archivo en el disco correspondiente
            //Selección de materias

            $file_subjects_selection = $request->file('subjects_selection');
            $name_subjects_selection = "ID_".$Petition->id."_CI_".$Petition->ID_user."_seleccion_de_materias.pdf";
            $path_subjects_selection = Storage::disk(\Config::get('constants.Disco'))->putFileAs(
                //*******************Se debe modificar el archivo config al para indicar el disco donde se guardaran los archivos*********************
                'subjects_selection', $file_subjects_selection, $name_subjects_selection
            );

            //constancia de notas
            $file_proof_notes = $request->file('proof_notes');
            $name_proof_notes = "ID_".$Petition->id."_CI_".$Petition->ID_user."_constancia_de_notas.pdf";
            $path_proof_notes = Storage::disk(\Config::get('constants.Disco'))->putFileAs(
                //*******************Se debe modificar el archivo config al para indicar el disco donde se guardaran los archivos*********************
                'proof_notes', $file_proof_notes, $name_proof_notes
            );

            //Selección de materias
            $file_reason_letter = $request->file('reason_letter');
            $name_reason_letter = "ID_".$Petition->id."_CI_".$Petition->ID_user."_carta_de_motivo.pdf";
            $path_reason_letter = Storage::disk(\Config::get('constants.Disco'))->putFileAs(
                //*******************Se debe modificar el archivo config al para indicar el disco donde se guardaran los archivos*********************
                'reason_letter', $file_reason_letter, $name_reason_letter
            );

            //Se actualiza la petición correspondiente
            Petition::where([
              ['confirmation_code', $Petition->confirmation_code],
              ['id', $Petition->id]
            ])->update([
              'collections' => '[
                  {"subjects_selection":"'.$path_subjects_selection.'"},
                  {"proof_notes":"'.$path_proof_notes.'"},
                  {"reason_letter":"'.$path_reason_letter.'"}
                ]',
                'confirmation_code' =>null,
                'info' => 'Esperando por respuesta',
            ]);
          }
          return redirect('/')->with('status-check', 'Petición completada con éxito');
        }

        catch (LogicException $e) {
            //Se actualiza la petición correspondiente
            Petition::where([
              ['confirmation_code', $Petition->confirmation_code],
              ['id', $Petition->id]
            ])->update([
                'info' => 'Error al tratar de procesar la petición, intente más tarde o trate de ponerse en contacto con la escuela de sistema',
            ]);
            return redirect('/')->with('status-danger', 'Error al tratar de procesar la petición, intente más tarde o trate de ponerse en contacto con la escuela de sistema');
        }
    }

    //Controlador para formulario de proyecto de grado
    public function uploadGraduation_project($ID, $code, request $request){

        //Prueba que se pueda descifrar el valor
        try {
            Crypt::decryptString($ID);
            Crypt::decryptString($code);
        } catch (DecryptException $e) {
            return redirect('/')->with('status-danger', 'La petición solicitada no existe en el sistema');
        }

        //Se verifica el contenido de la request
        $this->validate($request, [
            'grade_project_proposal_letter' => ['required','mimes:pdf'],
            'grade_project_proposal' => ['required','mimes:pdf'],
            'description_proposal' => ['required','mimes:pdf'],
            'letter_engagement' => ['required','mimes:pdf'],
        ]);

        //Se Busca la petición
        $Petition = Petition::where([
          ['id', Crypt::decryptString($ID)],
          ['confirmation_code', Crypt::decryptString($code)]
        ])->first();

        try{
          //Si la solicitud no se consigue
          if (! $Petition or !$Petition->confirmed)
            return redirect('/')->with('status-danger', 'La petición no existe o no está confirmada aún');

          //Verifica que la request tenga un archivo
          if($request->hasFile('grade_project_proposal') and $request->hasFile('description_proposal')
           and $request->hasFile('letter_engagement') and $request->hasFile('grade_project_proposal_letter') ){
            //Se guarda el archivo en una variable, se crea nombre unívoco para el archivo y Se guarda archivo en el disco correspondiente
            //Propuesta de proyecto de grado
            $file_grade_project_proposal_letter = $request->file('grade_project_proposal_letter');
            $name_grade_project_proposal_letter = "ID_".$Petition->id."_CI_".$Petition->ID_user."_carta_propuesta_proyecto_de_grado.pdf";
            $path_grade_project_proposal_letter = Storage::disk(\Config::get('constants.Disco'))->putFileAs(
                //*******************Se debe modificar el archivo config al para indicar el disco donde se guardaran los archivos*********************
                'grade_project_proposal_letter', $file_grade_project_proposal_letter, $name_grade_project_proposal_letter
            );

            //Carta de propuesta de proyecto de grado
            $file_grade_project_proposal = $request->file('grade_project_proposal');
            $name_grade_project_proposal = "ID_".$Petition->id."_CI_".$Petition->ID_user."_propuesta_proyecto_de_grado.pdf";
            $path_grade_project_proposal = Storage::disk(\Config::get('constants.Disco'))->putFileAs(
                //*******************Se debe modificar el archivo config al para indicar el disco donde se guardaran los archivos*********************
                'grade_project_proposal', $file_grade_project_proposal, $name_grade_project_proposal
            );

            //Descripción de la propuesta de grado
            $file_description_proposal = $request->file('description_proposal');
            $name_description_proposal = "ID_".$Petition->id."_CI_".$Petition->ID_user."_descripcion_propuesta.pdf";
            $path_description_proposal = Storage::disk(\Config::get('constants.Disco'))->putFileAs(
                //*******************Se debe modificar el archivo config al para indicar el disco donde se guardaran los archivos*********************
                'description_proposal', $file_description_proposal, $name_description_proposal
            );

            //Carta de compromiso
            $file_letter_engagement = $request->file('letter_engagement');
            $name_letter_engagement = "ID_".$Petition->id."_CI_".$Petition->ID_user."_carta_de_compromiso.pdf";
            $path_letter_engagement = Storage::disk(\Config::get('constants.Disco'))->putFileAs(
                //*******************Se debe modificar el archivo config al para indicar el disco donde se guardaran los archivos*********************
                'letter_engagement', $file_letter_engagement, $name_letter_engagement
            );

          //Se actualiza la petición correspondiente
          Petition::where([
            ['confirmation_code', $Petition->confirmation_code],
            ['id', $Petition->id]
          ])->update([
            'collections' => '[
                {"grade_project_proposal_letter":"'.$path_grade_project_proposal_letter.'"},
                {"grade_project_proposal":"'.$path_grade_project_proposal.'"},
                {"description_proposal":"'.$path_description_proposal.'"},
                {"letter_engagement":"'.$path_letter_engagement.'"}
              ]',
              'confirmation_code' =>null,
              'info' => 'Esperando por respuesta',
          ]);

          }
          return redirect('/')->with('status-check', 'Petición completada con éxito');
        }

        catch (LogicException $e) {
            //Se actualiza la petición correspondiente
            Petition::where([
              ['confirmation_code', $Petition->confirmation_code],
              ['id', $Petition->id]
            ])->update([
                'info' => 'Error al tratar de procesar la petición, intente más tarde o trate de ponerse en contacto con la escuela de sistema',
            ]);
            return redirect('/')->with('status-danger', 'Error al tratar de procesar la petición, intente más tarde o trate de ponerse en contacto con la escuela de sistema');
        }
  }

}
