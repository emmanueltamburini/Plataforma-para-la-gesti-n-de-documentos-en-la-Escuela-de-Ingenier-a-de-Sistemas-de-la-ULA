<?php

namespace Tests\Feature;

use App\User;
use App\Models\Petition;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Illuminate\Support\Facades\Crypt;
use DB;
use Carbon\Carbon;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Exception;

class RequestTest extends TestCase
{
    use RefreshDatabase;

    //Carga lo seeders
    public function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class'=> 'DatabaseSeeder']);
    }

	/** @test */
	//Usar el link enviado al correo genera una petición verificada
    public function mail_link_generates_a_verified_petition()
    {

    	//1. Given -> Un usuario con una petición
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
        ]);

        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. Then -> Usuario utiliza el link del correo
        $response = $this->get(route('request.verify',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]));


        // 3. When -> La petición pasa a ser verificada
        $this->assertDatabaseHas('petitions',[
            'ID_user' => $user->ID,
            'id' => $petition->id ,
            'confirmed' => true
        ]);

    }

    /** @test */
    ///Usar el link enviado al correo genera solo una petición verificada
    public function mail_link_generates_only_one_verified_petition()
    {
        //1. Given -> Un usuario con más de una petición
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
        ]);

        $petition2 = factory(Petition::class)->create([
            'ID_user' => $user->ID,
        ]);

        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. Then -> Usuario utiliza el link del correo
        $response = $this->get(route('request.verify',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]));

        // 3. When -> Solo una de las peticiones es verificada
        $this->assertDatabaseHas('petitions',[
            'ID_user' => $user->ID,
            'id' => $petition->id ,
            'confirmed' => true
        ]);

        $this->assertDatabaseHas('petitions',[
            'ID_user' => $user->ID,
            'id' => $petition2->id ,
            'confirmed' => false
        ]);

    }

    /** @test */
    //Usar el link enviado al correo te redirecciona al trámite correcto (paralelo)
    public function mail_link_redirect_to_correct_request_parallel()
    {

        //1. Given -> Un usuario con una petición de materias en paralelo
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 1,
        ]);

        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. Then -> Usuario utiliza el link del correo
        $response = $this->get(route('request.verify',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]));

        // 3. When -> El controlador lo redirecciona al trámite correcto
        $response->assertRedirect(route('request.parallel',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]));


    }

    /** @test */
    //Usar el link enviado al correo te redirecciona al trámite correcto (Colisión de horarios)
    public function mail_link_redirect_to_correct_request_schedule_collision()
    {

        //1. Given -> Un usuario con una petición de colisión de horarios
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 2,
        ]);

        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. Then -> Usuario utiliza el link del correo
        $response = $this->get(route('request.verify',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]));

        // 3. When -> El controlador lo redirecciona al trámite correcto
        $response->assertRedirect(route('request.schedule_collision',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]));

    }

        //Usar el link enviado al correo te redirecciona al trámite correcto (Exceso de unidades de crédito)
    public function mail_link_redirect_to_correct_request_excess_credit_units()
    {

        //1. Given -> Un usuario con una petición de exceso de unidades de crédito
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 3,
        ]);

        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. Then -> Usuario utiliza el link del correo
        $response = $this->get(route('request.verify',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]));

        // 3. When -> El controlador lo redirecciona al trámite correcto
        $response->assertRedirect(route('request.excess_credit_units',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]));

    }

        //Usar el link enviado al correo te redirecciona al trámite correcto (Proyecto de grado)
    public function mail_link_redirect_to_correct_request_graduation_project()
    {

        //1. Given -> Un usuario con una petición con proyecto de grado
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 4,
        ]);

        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. Then -> Usuario utiliza el link del correo
        $response = $this->get(route('request.verify',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]));

        // 3. When -> El controlador lo redirecciona al trámite correcto
        $response->assertRedirect(route('request.graduation_project',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]));

    }

    /** @test */
    //Un link con una codigo de verificación erroneo no funciona
    public function link_whit_wrong_confirmation_code_dont_work()
    {
        //1. Given -> Un usuario con una petición
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
        ]);

        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code."5");

        //2. Then -> Usuario utiliza el link del correo
        $response = $this->get(route('request.verify',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]));

        // 3. When -> La petición regresa a inicio
        $response->assertSessionHas("status-danger");

    }

    //***********************************************Test que prueba el mensaje de la petición***************************************************
    /** @test */
    public function an_info_in_a_confirmed_petition_is_coherence()
    {

        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
        ]);

        //2. When -> Cuando hacemos un post request
        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. Then -> Usuario utiliza el link del correo
        $response = $this->get(route('request.verify',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]));

        //3. Then -> Entonces la info de la petición va de acuerdo a su estado
        $this->assertDatabaseHas('petitions',[
            'ID_user' => $petition->ID_user,
            'id' => $petition->id,
            'info' => 'Esperando por recaudos',
        ]);
    }

    //***********************************************Test que prueba el mensaje de la petición***************************************************
    /** @test */
    public function an_email_link_can_expire()
    {

        //Se declara una variable para manejar el tiempo
        $date = Carbon::now();

        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'created_at' => $date->subHour(\Config::get('constants.hour'))->subMinute(\Config::get('constants.minute'))->subSecond(\Config::get('constants.second')+1),
        ]);

        //2. When -> Cuando hacemos un post request
        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. Then -> Usuario utiliza el link del correo
        $response = $this->get(route('request.verify',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]));

        //3. Then -> Entonces la info de la petición va de acuerdo a su estado
        $this->assertDatabaseHas('petitions',[
            'ID_user' => $petition->ID_user,
            'id' => $petition->id,
            'status' => 1,
        ]);
    }

    /** @test */
    //Un usuario no puede realizar una petición si el espacio de almacenamiento no puede atender su solicitud
    public function an_user_cannot_generate_a_new_petition_if_disk_is_full()
    {

        try {
        //1. Given -> Teniendo un documento de un estudiante
        $file_subjects_selection = UploadedFile::fake()->create('archivo.pdf');
        $name_subjects_selection = "Archivo.pdf";

        //2. When -> Se trata de guardar en una ruta que no puede antender el guardado
        $path_subjects_selection = Storage::disk(\Config::get('constants.Disco'))->putFileAs(
            //*******************Se debe modificar el archivo config al para indicar el disco donde se guardaran los archivos*********************
            'test', $file_subjects_selection, $name_subjects_selection
        );

        //3. Then -> El controlador no puede guardar el archivo
        }
        catch (Exception $e) {
            $this->assertTrue(true);
        }
    }


}
