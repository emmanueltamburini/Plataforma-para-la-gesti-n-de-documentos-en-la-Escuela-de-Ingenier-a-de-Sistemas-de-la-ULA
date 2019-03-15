<?php

namespace Tests\Feature;

use App\User;
use App\Models\Petition;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;
use Faker\Factory as Faker;
use DB;

class SearchTest extends TestCase
{
    use RefreshDatabase;

    //Carga lo seeders
    public function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class'=> 'DatabaseSeeder']);
    }

   //**********************************Test que prueba que el CI no puede  estar vacio (solapado con test posteior)****************************
    /** @test */
    public function search_an_id_cannot_be_empty()
    {
        //1. Given
        //******Sin condiciones previas******

        //2. When -> Cuando hacemos un post request con CI vacia
        $response = $this->post(route('search.find') ,[
            'ID' => ''
        ]);

        //3. Then -> Entonces se consigue un error
        $response->assertSessionHasErrors('ID');
    }

    //********************************Test que prueba que la nacionalidad no puede  estar vacio (solapado con test posteior)*******************************
    /** @test */
    public function search_a_nationality_cannot_be_empty()
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

    //**********************************************Test que prueba que CI debe estar sea formato adecuado*************************************
    /** @test */
    public function search_an_id_must_be_in_format()
    {
        //1. Given
         //******Sin condiciones previas******

        //2. When -> Cuando hacemos un post con CI con formato errado
        $response = $this->post(route('search.find') ,[
            'ID' => strval(random_int(0,999999))
        ]);

        //3. Then -> Entonces se consigue un error
        $response->assertSessionHasErrors('ID');
    }

    //********************************************Test que prueba que la nacionalidad debe estar sea formato adecuado*************************************
    /** @test */
    public function search_a_nationality_must_be_in_format()
    {
        //Se crea un Faker para emular datos incorrectos
        $faker  = Faker::create();

        //1. Given
         //******Sin condiciones previas******

        //2. When -> Cuando hacemos un post con CI con formato errado
        $response = $this->post(route('search.find') ,[
            'nationality' => $faker->randomLetter
        ]);

        //3. Then -> Entonces se consigue un error
        $response->assertSessionHasErrors('nationality');
    }

    //**********************************************Test que prueba que el controlador redireccione correctamente*************************************
    /** @test */
    public function search_redirect_to_correct_link()
    {

        //1. Given -> Teniendo un usuario
         $user = factory(User::class)->make();

        //Se divide la CI de la nacionalidad por formato de planilla HTML
        $ID = substr($user->ID, 1);
        $nationality = substr($user->ID, 0 , 1);

        //2. When -> Cuando hacemos un post
        $response = $this->post(route('search.find') ,[
            'nationality' =>$nationality,
            'ID' => $ID ,
        ]);

        //3. Then -> Redirecciona la ruta correcta
        $response->assertRedirect(route('search.found',[
            'ID'   =>  $user->ID,
        ]));
    }

    //*****************************************Test que prueba que el controlador realiza busquedad exitodsas*************************************
    /** @test */
    public function search_ID_with_petitions_works_fine()
    {

        //1. Given -> Teniendo un usuario con varias peticiones
        $user = factory(User::class)->create();
        for ($i = 0; $i < 10; $i++) {
            $petition[$i] = factory(Petition::class)->create([
                'ID_user' => $user->ID,
                'confirmed' => true,
            ]);
        }

        //2. When -> Cuando hacemos un post
        $response = $this->get(route('search.found',[
            'ID' => $user->ID,
        ]));

        //Se usa para pasar de un objeto collection a un arreglo json para ser iterado
        $arrayjson=$response->getOriginalContent()->getData();


        //3. Then -> Redirecciona la ruta correcta
        $response->assertViewHas('status_check');
        for ($i = 0; $i < sizeof($arrayjson['petitions']); $i++) {
            $this->assertSame($user->ID,$arrayjson['petitions'][$i]['ID_user']);
        }

    }

    //*****************************************Test que prueba que el controlador realiza busquedad exitodsas*************************************
    /** @test */
    public function search_ID_without_petitions_works_fine()
    {

        //1. Given -> No teniendo un usuario
        $user = factory(User::class)->make();

        //2. When -> Cuando hacemos un post
        $response = $this->get(route('search.found',[
            'ID' => $user->ID,
        ]));

        //3. Then -> Redirecciona la ruta correcta
        $response->assertViewHas('status_danger');
    }

    //*****************************************Test que prueba que el controlador que envía correo con peticioness*************************************
    /** @test */
    public function send_email_with_petitions_works()
    {
        $this->withoutExceptionHandling();
        //1. Given -> No teniendo un usuario
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user'   =>  $user->ID,
        ]);

        //2. When -> Cuando hacemos un post
        $response = $this->post(route('search.found',[
            'ID' => $user->ID,
        ]));

        //3. Then -> Redirecciona la ruta correcta
        $response->assertViewHas('status_check');

    }
}
