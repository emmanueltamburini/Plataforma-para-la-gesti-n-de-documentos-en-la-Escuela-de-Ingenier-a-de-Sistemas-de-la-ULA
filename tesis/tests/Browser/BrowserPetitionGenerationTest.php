<?php

namespace Tests\Browser;

use App\User;
use App\Models\Petition;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Faker\Factory as Faker;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BrowserPetitionGenerationTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class'=> 'DatabaseSeeder']);
    }

    //Un usuario con ID incorrecta no puede crear solicitud
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function an_user_cannot_generation_petition_with_bad_ID()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->make([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->make([
            'ID_user' => $user->ID,
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Se divide la CI de la nacionalidad por formato de planilla HTML
            $ID = substr($user->ID, 1);
            $nationality = substr($user->ID, 0 , 1);

            $browser->visit(route('petitions'))
                    ->select('nationality',$nationality)
                    ->type('ID', random_int(0,999999) )
                    ->type('name', $user->name)
                    ->type('email', $user->email)
                    ->select('request_type', $petition->request_type)
                    ->select('area',$user->area)
                    ->press('#Enviar')
                    ->assertDontSee('Email envíado correctamente a: '.$user->email)
                    ->assertUrlIs("http://tesis.test/Solicitud");

        });
    }

    //Un usuario con correo no ula no puede crear solicitud
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function an_user_cannot_generation_petition_with_email_no_ula()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->make([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->make([
            'ID_user' => $user->ID,
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Se divide la CI de la nacionalidad por formato de planilla HTML
            $ID = substr($user->ID, 1);
            $nationality = substr($user->ID, 0 , 1);
            //Se crea un Faker para emular datos incorrectos
            $faker  = Faker::create();

            $browser->visit(route('petitions'))
                    ->select('nationality',$nationality)
                    ->type('ID', $ID)
                    ->type('name', $user->name)
                    ->type('email', $faker->unique()->safeEmail)
                    ->select('request_type', $petition->request_type)
                    ->select('area',$user->area)
                    ->press('#Enviar')
                    ->assertDontSee('Email envíado correctamente a: '.$user->email)
                    ->assertUrlIs("http://tesis.test/Solicitud");

        });
    }

    //Un usuario sin ID no puede crear solicitud
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function an_user_cannot_generation_petition_without_ID()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->make([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->make([
            'ID_user' => $user->ID,
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Se divide la CI de la nacionalidad por formato de planilla HTML
            $ID = substr($user->ID, 1);
            $nationality = substr($user->ID, 0 , 1);

            $browser->visit(route('petitions'))
                    ->select('nationality',$nationality)
                    ->type('ID', "" )
                    ->type('name', $user->name)
                    ->type('email', $user->email)
                    ->select('request_type', $petition->request_type)
                    ->select('area',$user->area)
                    ->press('#Enviar')
                    ->assertDontSee('Email envíado correctamente a: '.$user->email)
                    ->assertUrlIs("http://tesis.test/Solicitud");

        });
    }

    //Un usuario sin correo no puede crear solicitud
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function an_user_cannot_generation_petition_without_email()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->make([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->make([
            'ID_user' => $user->ID,
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Se divide la CI de la nacionalidad por formato de planilla HTML
            $ID = substr($user->ID, 1);
            $nationality = substr($user->ID, 0 , 1);

            $browser->visit(route('petitions'))
                    ->select('nationality',$nationality)
                    ->type('ID', $ID)
                    ->type('name', $user->name)
                    ->type('email', "")
                    ->select('request_type', $petition->request_type)
                    ->select('area',$user->area)
                    ->press('#Enviar')
                    ->assertDontSee('Email envíado correctamente a: '.$user->email)
                    ->assertUrlIs("http://tesis.test/Solicitud");

        });
    }

    //Un usuario no puede crear una soliciitud si nombre
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function an_user_cannot_generation_petition_without_name()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->make([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->make([
            'ID_user' => $user->ID,
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Se divide la CI de la nacionalidad por formato de planilla HTML
            $ID = substr($user->ID, 1);
            $nationality = substr($user->ID, 0 , 1);

            $test=$browser->visit(route('petitions'))
                    ->select('nationality',$nationality)
                    ->type('ID', $ID )
                    ->click('#name')
                    ->pause(2000)
                    ->type('name', "")
                    ->type('email', $user->email)
                    ->select('request_type', $petition->request_type)
                    ->select('area',$user->area)
                    ->press('#Enviar')
                    ->assertDontSee('Email envíado correctamente a: '.$user->email)
                    ->assertUrlIs("http://tesis.test/Solicitud");
        });
    }


    //Un usuario puede crear con éxito una soliciitud
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function an_user_can_generation_petition()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->make([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->make([
            'ID_user' => $user->ID,
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Se divide la CI de la nacionalidad por formato de planilla HTML
            $ID = substr($user->ID, 1);
            $nationality = substr($user->ID, 0 , 1);

            $test=$browser->visit(route('petitions'))
                    ->select('nationality',$nationality)
                    ->type('ID', $ID )
                    ->click('#name')
                    ->pause(2000)
                    ->type('name', $user->name)
                    ->type('email', $user->email)
                    ->select('request_type', $petition->request_type)
                    ->select('area',$user->area)
                    ->press('#Enviar')
                    ->assertSee('Email envíado correctamente a: '.$user->email)
                    ->assertUrlIs("http://tesis.test/");
        });
    }

    //El formulario se auto llena para un usuario exisitente
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function form_is_autocompleted_for_an_existing_user()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Se divide la CI de la nacionalidad por formato de planilla HTML
            $ID = substr($user->ID, 1);
            $nationality = substr($user->ID, 0 , 1);

            $test=$browser->visit(route('petitions'))
                    ->select('nationality',$nationality)
                    ->type('ID', $ID )
                    ->click('#name')
                    ->pause(2000)
                    ->assertInputValue('name', $user->name)
                    ->assertSelected('area', $user->area);
        });
    }

    //**************************Test que prueba que un usuario que no este en la lista no puede generar peticiones***************************************
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */
    public function an_user_who_isnt_in_list_cant_generate_petition()
    {

        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->make([
            'ID' => 'V'.random_int(1000000,20000000)
        ]);
        $petition = factory(Petition::class)->make([
            'ID_user' => $user->ID,
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Se divide la CI de la nacionalidad por formato de planilla HTML
            $ID = substr($user->ID, 1);
            $nationality = substr($user->ID, 0 , 1);

            $test=$browser->visit(route('petitions'))
                    ->select('nationality',$nationality)
                    ->type('ID', $ID )
                    ->click('#name')
                    ->pause(2000)
                    ->type('name', $user->name)
                    ->type('email', $user->email)
                    ->select('request_type', $petition->request_type)
                    ->select('area',$user->area)
                    ->press('#Enviar')
                    ->assertSee('La CI '. $user->ID. ' no aparece en la lista de usuarios, por favor comunicarse con la escuela de sistema')
                    ->assertUrlIs("http://tesis.test/Solicitud");
        });

    }

    //**************************Test que prueba que un usuario debe colocar el email que se encuentra en la lista***************************************
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */
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

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Se divide la CI de la nacionalidad por formato de planilla HTML
            $ID = substr($user->ID, 1);
            $nationality = substr($user->ID, 0 , 1);

            $test=$browser->visit(route('petitions'))
                    ->select('nationality',$nationality)
                    ->type('ID', $ID )
                    ->click('#name')
                    ->pause(2000)
                    ->type('name', $user->name)
                    ->type('email', $user->email)
                    ->select('request_type', $petition->request_type)
                    ->select('area',$user->area)
                    ->press('#Enviar')
                    ->assertSee('El email: ' . $user->email.' no corresponde a la CI '. $user->ID)
                    ->assertUrlIs("http://tesis.test/Solicitud");
        });

    }

}
