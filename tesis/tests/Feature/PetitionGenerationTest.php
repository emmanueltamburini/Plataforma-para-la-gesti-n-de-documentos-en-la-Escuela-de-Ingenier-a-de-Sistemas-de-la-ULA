<?php

namespace Tests\Feature;

use App\User;
use App\Models\Petition;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory as Faker;
use DB;
use Carbon\Carbon;
use App\Lista;

class PetitionGenerationTest extends TestCase
{
    use RefreshDatabase;

    //Carga lo seeders
    public function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class'=> 'DatabaseSeeder']);
    }

    //************************************Test que prueba que el nombre no puede estar vacio**************************************************************
    /** @test */
    public function a_name_cannot_be_empty()
    {
        //1. Given
        //******Sin condiciones previas******

        //2. When -> Cuando hacemos un post request con email vacio
        $response = $this->post(route('petitions.store') ,[
            'name' => ''
        ]);

        //3. Then -> Entonces se consigue un error
        $response->assertSessionHasErrors('name');

    }

    //************************************Test que prueba que el email no puede  estar vacio (solapado con test posteior)*********************************
    /** @test */
    public function an_email_cannot_be_empty()
    {
        //1. Given
        //******Sin condiciones previas******

        //2. When -> Cuando hacemos un post request con email vacio
        $response = $this->post(route('petitions.store') ,[
            'email' => ''
        ]);

        //3. Then -> Entonces se consigue un error
        $response->assertSessionHasErrors('email');

    }


    //*****************************************************Test que prueba fallo con correo no ULA***************************************************
    /** @test */
    public function an_email_cannot_be_no_ula()
    {
        //Se crea un Faker para emular datos incorrectos
        $faker  = Faker::create();

        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->make();
        $petition = factory(Petition::class)->make([
            'ID_user' => $user->ID,
        ]);
        //2. When -> Cuando hacemos un post con correo no ULA
        $response = $this->post(route('petitions.store') ,[
            'email' => $faker->unique()->safeEmail,
        ]);

        //3. Then -> Entonces se consigue un error
        $response->assertSessionHasErrors('email');
    }

    //************************************Test que prueba que el CI no puede  estar vacio (solapado con test posteior)************************************
    /** @test */
    public function an_id_cannot_be_empty()
    {
        //1. Given
        //******Sin condiciones previas******

        //2. When -> Cuando hacemos un post request con CI vacia
        $response = $this->post(route('petitions.store') ,[
            'ID' => ''
        ]);

        //3. Then -> Entonces se consigue un error
        $response->assertSessionHasErrors('ID');
    }

    //********************************Test que prueba que la nacionalidad no puede  estar vacio (solapado con test posteior)*******************************
    /** @test */
    public function a_nationality_cannot_be_empty()
    {
        //1. Given
        //******Sin condiciones previas******

        //2. When -> Cuando hacemos un post request con CI vacia
        $response = $this->post(route('petitions.store') ,[
            'nationality' => ''
        ]);

        //3. Then -> Entonces se consigue un error
        $response->assertSessionHasErrors('nationality');
    }

    //**********************************************Test que prueba que CI debe estar sea formato adecuado***********************************************
    /** @test */
    public function an_id_must_be_in_format()
    {
        //1. Given -> Teniendo un usuario
        //******Sin condiciones previas******

        //2. When -> Cuando hacemos un post con CI con formato errado
        $response = $this->post(route('petitions.store') ,[
            'ID' => random_int(0,999999)
        ]);

        //3. Then -> Entonces se consigue un error
        $response->assertSessionHasErrors('ID');
    }

    //*************************************Test que prueba que la nacionalidad  debe estar sea formato adecuado*******************************************
    /** @test */
    public function a_nationality_must_be_in_format()
    {
        //Se crea un Faker para emular datos incorrectos
        $faker  = Faker::create();

        //1. Given -> Teniendo un usuario
        //******Sin condiciones previas******

        //2. When -> Cuando hacemos un post con CI con formato errado
        $response = $this->post(route('petitions.store') ,[
            'nationality' => $faker->randomLetter
        ]);

        //3. Then -> Entonces se consigue un error
        $response->assertSessionHasErrors('nationality');
    }

    //*************************************Test que prueba que el tipo de solicitud no peude ser vacio*******************************************
    /** @test */
    public function a_procedure_cannot_be_empty()
    {
        //1. Given
        //******Sin condiciones previas******

        //2. When -> Cuando hacemos un post con tipo de solicitud vacio
        $response = $this->post(route('petitions.store') ,[
            'request_type' => "",

        ]);

        //3. Then -> Entonces se consigue un error
        $response->assertSessionHasErrors('request_type');
    }

    //*************************************Test que prueba que la carrera no peude ser vacia*******************************************
    /** @test */
    public function an_area_cannot_be_empty()
    {
        //1. Given
        //******Sin condiciones previas******

        //2. When -> Cuando hacemos un post con tipo de solicitud vacio
        $response = $this->post(route('petitions.store') ,[
            'area' => "",
        ]);

        //3. Then -> Entonces se consigue un error
        $response->assertSessionHasErrors('area');
    }

    //*************************Test que prueba el llenado el contralador mediante envío y guardado en base de datos********************************
    /** @test */
    public function an_user_can_generation_petition()
    {
        $this->withoutExceptionHandling();

        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->make();
        $petition = factory(Petition::class)->make([
            'ID_user' => $user->ID,
        ]);

        //Se divide la CI de la nacionalidad por formato de planilla HTML
        $ID = substr($user->ID, 1);
        $nationality = substr($user->ID, 0 , 1);


        //2. When -> Cuando hacemos un post request
        $response = $this->post(route('petitions.store') ,[
            'name' => $user->name,
            'email' => $user->email,
            'nationality' =>$nationality,
            'ID' => $ID ,
            'request_type' => $petition->request_type,
            'area' => $user->area
        ]);

        $response->assertRedirect('/');

        //3. Then -> Entonces veo un nuevo miembro en la base de datos
        $this->assertDatabaseHas('users',[
            'name' => $user->name,
            'email' => $user->email,
            'ID' => $user->ID,
            'area' => $user->area
        ]);

        $this->assertDatabaseHas('petitions',[
            'ID_user' => $petition->ID_user,
            'request_type' => $petition->request_type,
        ]);
    }

    //***********************************************Test que prueba el mensaje de la petición***************************************************
    /** @test */
    public function an_info_in_a_new_petition_is_coherence()
    {

        //1. Given
        //******Sin condiciones previas******

        //2. When -> Cuando hacemos un post request
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
        ]);

        //3. Then -> Entonces la info de la petición va de acuerdo a su estado
        $this->assertDatabaseHas('petitions',[
            'ID_user' => $petition->ID_user,
            'id' => $petition->id,
            'info' => 'Esperando confirmación de correo',
        ]);
    }

    //****************************************************Test que prueba el estado del mensaje***************************************************
    /** @test */
    public function a_status_in_new_a_petition_is_coherence()
    {

        //1. Given
        //******Sin condiciones previas******

        //2. When -> Cuando hacemos un post request
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
        ]);

        //3. Then -> Entonces el estado de la petición va de acuerdo a su estado actual de la misma
        $this->assertDatabaseHas('petitions',[
            'ID_user' => $petition->ID_user,
            'id' => $petition->id,
            'status' => 2,
        ]);
    }

    //**************************Test que prueba que un usuario puedo actualizar sus datos********************************
    /** @test */
    public function an_user_can_update_your_data()
    {
        $this->withoutExceptionHandling();

        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->make([
            'ID_user' => $user->ID,
        ]);
        //Se divide la CI de la nacionalidad por formato de planilla HTML
        $ID = substr($user->ID, 1);
        $nationality = substr($user->ID, 0 , 1);

        //Otro usuario para actualizar datos
        $user1 = factory(User::class)->make();

        //2. When -> Cuando hacemos un post request
        $response = $this->post(route('petitions.store') ,[
            'name' => $user1->name,
            'email' => $user->email,
            'nationality' =>$nationality,
            'ID' => $ID ,
            'request_type' => $petition->request_type,
            'area' => $user->area,
        ]);

        $response->assertRedirect('/');

        //3. Then -> Entonces veo un nuevo miembro en la base de datos
        $this->assertDatabaseHas('users',[
            'name' => $user1->name,
            'email' => $user->email,
            'ID' => $user->ID,
            'area' => $user->area,
        ]);

        $this->assertDatabaseHas('petitions',[
            'ID_user' => $petition->ID_user,
            'request_type' => $petition->request_type,
        ]);
    }

    //************************************Test que prueba mensaje de éxito al enviar petición*************************************************************
    /** @test */
    public function a_successful_request_send_a_successful_message()
    {
        $this->withoutExceptionHandling();

        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->make();
        $petition = factory(Petition::class)->make([
            'ID_user' => $user->ID,
        ]);

        //Se divide la CI de la nacionalidad por formato de planilla HTML
        $ID = substr($user->ID, 1);
        $nationality = substr($user->ID, 0 , 1);


        //2. When -> Cuando hacemos un post request
        $response = $this->post(route('petitions.store') ,[
            'name' => $user->name,
            'email' => $user->email,
            'nationality' =>$nationality,
            'ID' => $ID ,
            'request_type' => $petition->request_type,
            'area' => $user->area
        ]);

        $response->assertRedirect('/');

        //3. Then -> Entonces veo que se envía el mensaje de confirmación
        $response->assertSessionHas("status-check");

    }

    //**************************Test que prueba que un usuario que no este en la lista no puede generar peticiones***************************************
    /** @test */
    public function an_user_who_isnt_in_list_cant_generate_petition()
    {

        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->make([
            'ID' => 'V'.random_int(1000000,20000000)
        ]);
        $petition = factory(Petition::class)->make([
            'ID_user' => $user->ID,
        ]);

        //Se divide la CI de la nacionalidad por formato de planilla HTML
        $ID = substr($user->ID, 1);
        $nationality = substr($user->ID, 0 , 1);


        //2. When -> Cuando hacemos un post request
        $response = $this->post(route('petitions.store') ,[
            'name' => $user->name,
            'email' => $user->email,
            'nationality' =>$nationality,
            'ID' => $ID ,
            'request_type' => $petition->request_type,
            'area' => $user->area
        ]);

        $response->assertRedirect('/Solicitud');

        //3. Then -> Entonces veo que se envía el mensaje de advertencia
        $response->assertSessionHas("status-danger");

    }

    //**************************Test que prueba que un usuario debe colocar el email que se encuentra en la lista***************************************
    /** @test */
    public function an_user_must_put_the_email_that_be_in_the_list()
    {
        //Se crea un Faker para emular datos incorrectos
        $faker  = Faker::create();

        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->make([
            'email' => str_replace(array(" ", "'"), '',$faker->unique()->name . $faker->unique()->randomNumber() . "@ula.ve")
        ]);
        $petition = factory(Petition::class)->make([
            'ID_user' => $user->ID,
        ]);

        //Se divide la CI de la nacionalidad por formato de planilla HTML
        $ID = substr($user->ID, 1);
        $nationality = substr($user->ID, 0 , 1);


        //2. When -> Cuando hacemos un post request
        $response = $this->post(route('petitions.store') ,[
            'name' => $user->name,
            'email' => $user->email,
            'nationality' =>$nationality,
            'ID' => $ID ,
            'request_type' => $petition->request_type,
            'area' => $user->area
        ]);

        $response->assertRedirect('/Solicitud');

        //3. Then -> Entonces veo que se envía el mensaje de advertencia
        $response->assertSessionHas("status-danger");

    }
}
