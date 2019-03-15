<?php

namespace Tests\Browser;

use App\User;
use App\Models\Petition;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BrowserFoundTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class'=> 'DatabaseSeeder']);
    }

    //Un usuario de la plataforma no exisitente es informado de ellos
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function an_user_without_petitions_cannot_find_them()
    {

        $this->browse(function (Browser $browser) {

            //1. Given -> Teniendo un usuario
            $user = factory(User::class)->make([
                'area' => random_int(1,3)
            ]);

            $browser->visit(route('search.found',['ID'   =>  $user->ID]))
                    ->assertSee("Usuario con ".$user->ID." no encontrado")
                    ->assertUrlIs(route('search.found',['ID'   =>  $user->ID]));

        });
    }

    //Una petición encontrada muestra su número de solicitud
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_petiton_shows_its_request_number()
    {

        $this->browse(function (Browser $browser) {

            //1. Given -> Teniendo un usuario
            $user = factory(User::class)->create([
                'area' => random_int(1,3)
            ]);

            $petition = factory(Petition::class)->create([
                'ID_user' => $user->ID,
                'request_type' => 3,
            ]);

            $browser->visit(route('search.found',['ID'   =>  $user->ID]))
                    ->assertSee("Usuario con ".$user->ID." encontrado con éxito")
                    ->assertSee($petition->ID_user."-".$petition->id)
                    ->assertUrlIs(route('search.found',['ID'   =>  $user->ID]));

        });
    }

    //Una petición encontrada muestra su tipo de solicitud
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_petiton_shows_its_request_type()
    {

        $this->browse(function (Browser $browser) {

            //1. Given -> Teniendo un usuario
            $user = factory(User::class)->create([
                'area' => random_int(1,3)
            ]);

            $petition = factory(Petition::class)->create([
                'ID_user' => $user->ID,
                'request_type' => 3,
            ]);

            $browser->visit(route('search.found',['ID'   =>  $user->ID]))
                    ->assertSee("Usuario con ".$user->ID." encontrado con éxito")
                    ->assertSee($petition->request_type()->get()[0]->info)
                    ->assertUrlIs(route('search.found',['ID'   =>  $user->ID]));

        });
    }

    //Una petición encontrada muestra su estado de solicitud
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_petiton_shows_its_request_status()
    {

        $this->browse(function (Browser $browser) {

            //1. Given -> Teniendo un usuario
            $user = factory(User::class)->create([
                'area' => random_int(1,3)
            ]);

            $petition = factory(Petition::class)->create([
                'ID_user' => $user->ID,
                'request_type' => 3,
            ]);

            $browser->visit(route('search.found',['ID'   =>  $user->ID]))
                    ->assertSee("Usuario con ".$user->ID." encontrado con éxito")
                    ->assertSee($petition->status()->get()[0]->info)
                    ->assertUrlIs(route('search.found',['ID'   =>  $user->ID]));

        });
    }

    //Una petición encontrada muestra su fecha
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_petiton_shows_its_date()
    {

        $this->browse(function (Browser $browser) {

            //1. Given -> Teniendo un usuario
            $user = factory(User::class)->create([
                'area' => random_int(1,3)
            ]);

            $petition = factory(Petition::class)->create([
                'ID_user' => $user->ID,
                'request_type' => 3,
            ]);

            $browser->visit(route('search.found',['ID'   =>  $user->ID]))
                    ->assertSee("Usuario con ".$user->ID." encontrado con éxito")
                    ->assertSee(DATE_FORMAT($petition['created_at'], "d-m-Y") )
                    ->assertUrlIs(route('search.found',['ID'   =>  $user->ID]));

        });
    }

    //Un usuario con una petición puede conseguirla
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function an_user_with_a_petition_can_find_it()
    {

        $this->browse(function (Browser $browser) {

            //1. Given -> Teniendo un usuario
            $user = factory(User::class)->create([
                'area' => random_int(1,3)
            ]);

            $petition = factory(Petition::class)->create([
                'ID_user' => $user->ID,
                'request_type' => 3,
            ]);

            $browser->visit(route('search.found',['ID'   =>  $user->ID]))
                    ->assertSee("Usuario con ".$user->ID." encontrado con éxito")
                    ->assertSee($petition->ID_user."-".$petition->id)
                    ->assertSee($petition->request_type()->get()[0]->info)
                    ->assertSee($petition->status()->get()[0]->info)
                    ->assertUrlIs(route('search.found',['ID'   =>  $user->ID]));

        });
    }

    //Un usuario con peticiones pueden conseguirlas
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function an_user_with_petitions_can_find_them()
    {

        $this->browse(function (Browser $browser) {

            //1. Given -> Teniendo un usuario
            $user = factory(User::class)->create([
                'area' => random_int(1,3)
            ]);

            for ($i = 0; $i < 3; $i++) {
                $petition[$i] = factory(Petition::class)->create([
                    'ID_user' => $user->ID,
                ]);
            }

            $browser->visit(route('search.found',['ID'   =>  $user->ID]))
                    ->assertSee("Usuario con ".$user->ID." encontrado con éxito")
                    ->assertSee($petition[0]->ID_user."-".$petition[0]->id)
                    ->assertSee($petition[1]->ID_user."-".$petition[1]->id)
                    ->assertSee($petition[2]->ID_user."-".$petition[2]->id)
                    ->assertUrlIs(route('search.found',['ID'   =>  $user->ID]));

        });
    }

    //Un usuario con una petición puede ver su info
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function an_user_with_petition_can_see_its_info()
    {

        $this->browse(function (Browser $browser) {

            //1. Given -> Teniendo un usuario
            $user = factory(User::class)->create([
                'area' => random_int(1,3)
            ]);

            $petition = factory(Petition::class)->create([
                'ID_user' => $user->ID,
                'info' => 'Esperando confirmación de correo'
            ]);

            $browser->visit(route('search.found',['ID'   =>  $user->ID]))
                    ->assertSee("Usuario con ".$user->ID." encontrado con éxito")
                    ->assertSee($petition->ID_user."-".$petition->id)
                    ->press('#I'.$petition->id)
                    ->pause(1000)
                    ->assertSee($petition->info)
                    ->assertUrlIs(route('search.found',['ID'   =>  $user->ID]));

        });
    }

    //Un usuario puede solicitar un correo con sus peticiones
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function an_user_can_solicit_an_email_with_their_petitions()
    {
        $this->browse(function (Browser $browser) {

            //1. Given -> Teniendo un usuario
            $user = factory(User::class)->create([
                'area' => random_int(1,3)
            ]);

            $petition = factory(Petition::class,3)->create([
                'ID_user' => $user->ID,
                'info' => 'Esperando confirmación de correo'
            ]);

            $browser->visit(route('search.found',['ID'   =>  $user->ID]))
                    ->assertSee("Usuario con ".$user->ID." encontrado con éxito")
                    ->press('#Send')
                    ->pause(1000)
                    ->press('#Accept_send')
                    ->assertSee("Correo enviado con éxito al correo asociado a la cédula ".$user->ID)
                    ->assertUrlIs(route('search.found',['ID'   =>  $user->ID]));

        });
    }


    //Un usuario puede solicitar cancelar la solicitud del correo con sus peticciones
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function an_user_can_cancel_the_solicit_an_email_with_their_petitions()
    {
        $this->browse(function (Browser $browser) {

            //1. Given -> Teniendo un usuario
            $user = factory(User::class)->create([
                'area' => random_int(1,3)
            ]);

            $petition = factory(Petition::class,3)->create([
                'ID_user' => $user->ID,
                'info' => 'Esperando confirmación de correo'
            ]);

            $browser->visit(route('search.found',['ID'   =>  $user->ID]))
                    ->assertSee("Usuario con ".$user->ID." encontrado con éxito")
                    ->press('#Send')
                    ->pause(1000)
                    ->press('#Cancel_send')
                    ->assertSee("Usuario con ".$user->ID." encontrado con éxito")
                    ->assertUrlIs(route('search.found',['ID'   =>  $user->ID]));

        });
    }
}
