<?php

namespace Tests\Browser;

use App\User;
use App\Models\Petition;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BrowserSearchTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class'=> 'DatabaseSeeder']);
    }

    //Un usuario no puede no poner su CI
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function an_ID_cannot_be_empty_in_a_Search()
    {

        $this->browse(function (Browser $browser) {

            $browser->visit(route('search.find'))
                    ->assertSee('Búscador de solicitudes')
                    ->press('#Buscar')
                    ->assertUrlIs(route('search.find'));

        });
    }

    //Un usuario no puede no poner una cédula fuera de formato
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function an_ID_cannot_have_bad_format_in_a_Search()
    {

        $this->browse(function (Browser $browser) {

            $ID = random_int(0,999999);

            $browser->visit(route('search.find'))
                    ->type('ID',  $ID)
                    ->assertSee('Búscador de solicitudes')
                    ->press('#Buscar')
                    ->assertUrlIs(route('search.find'));

        });
    }

    //Un usuario puede encontrar sus solicitudes
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function an_user_can_find_their_request()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);

        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 3,
        ]);

        $this->browse(function (Browser $browser) use($user) {

            //Se divide la CI de la nacionalidad por formato de planilla HTML
            $ID = substr($user->ID, 1);
            $nationality = substr($user->ID, 0 , 1);

            $browser->visit(route('search.find'))
                    ->assertSee('Búscador de solicitudes')
                    ->select('nationality',$nationality)
                    ->type('ID',  $ID)
                    ->press('#Buscar')
                    ->assertUrlIs(route('search.found',['ID'   =>  $user->ID]));

        });
    }

    //Un usuario no existente no puede encontrar sus solicitudes
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_non_existent_user_cannot_find_request()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->make([
            'area' => random_int(1,3)
        ]);

        $this->browse(function (Browser $browser) use($user) {

            //Se divide la CI de la nacionalidad por formato de planilla HTML
            $ID = substr($user->ID, 1);
            $nationality = substr($user->ID, 0 , 1);

            $browser->visit(route('search.find'))
                    ->assertSee('Búscador de solicitudes')
                    ->select('nationality',$nationality)
                    ->type('ID',  $ID)
                    ->press('#Buscar')
                    ->assertUrlIs(route('search.found',['ID'   =>  $user->ID]));

        });

    }


}