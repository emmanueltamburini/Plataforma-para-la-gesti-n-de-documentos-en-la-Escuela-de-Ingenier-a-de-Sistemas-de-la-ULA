<?php

namespace Tests\Browser;

use App\User;
use App\Models\Petition;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Carbon\Carbon;

class BrowserRequestGenerationTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class'=> 'DatabaseSeeder']);
    }

    //Un link de correo correcto para el trámite materias en paralelo redireccina de manera correcta
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_correct_parallel_link_email_redirect_good()
    {
        //1. Given -> Teniendo un usuario con peticiones
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 1
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            //2. When -> Un usuario ingresa al link de verificación
            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
            //3. Given -> es redireccionado al formulario correcto
                    ->assertUrlIs("http://tesis.test/MateriasParalelo/".$ID_crypt."/".$code_crypt);

        });
    }

    //Un link de correo correcto para el trámite Colision de Horario redireccina de manera correcta
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_correct_schedule_collision_link_email_redirect_good()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 2
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
                    ->assertUrlIs("http://tesis.test/ColisionHorario/".$ID_crypt."/".$code_crypt);

        });
    }

    //Un link de correo correcto para el trámite Exceso de Unidades redireccina de manera correcta
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_correct_excess_credit_units_link_email_redirect_good()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 3
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
                    ->assertUrlIs("http://tesis.test/ExcesoUnidades/".$ID_crypt."/".$code_crypt);

        });
    }

    //Un link de correo correcto para el trámite Proyecto de Grado redireccina de manera correcta
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_correct_graduation_project_link_email_redirect_good()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 4
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
                    ->assertUrlIs("http://tesis.test/ProyectoGrado/".$ID_crypt."/".$code_crypt);

        });
    }

    //Un link de correo incorrecto redireciona a la página de inicio
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_incorrect_link_email_redirect_good()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->make([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->make([
            'ID_user' => $user->ID,
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            //Prueba con usuario no encontrado
            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
                    ->assertSee('La petición solicitada no existe en el sistema')
                    ->assertUrlIs("http://tesis.test/");

            //Prueba con número aleatorios
            $browser->visit(route('request.verify',['ID'   =>  random_int(0,100000),'code' =>  random_int(0,100000)]))
                    ->assertSee('La petición solicitada no existe en el sistema')
                    ->assertUrlIs("http://tesis.test/");
        });
    }

    //Un link de correo incorrecto redireciona a la página de inicio
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function an_email_link_can_expire_browser()
    {

        //Se declara una variable para manejar el tiempo
        $date = Carbon::now();

        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'created_at' => $date->subHour(\Config::get('constants.hour'))->subMinute(\Config::get('constants.minute'))->subSecond(\Config::get('constants.second')+1),
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            //Prueba con usuario no encontrado
            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
                    ->assertSee('La petición solicitada a caducado')
                    ->assertUrlIs("http://tesis.test/");
        });
    }
}
