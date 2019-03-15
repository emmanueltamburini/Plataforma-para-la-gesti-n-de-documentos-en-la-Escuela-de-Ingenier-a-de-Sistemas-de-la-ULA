<?php

namespace Tests\Browser;

use App\User;
use App\Models\Petition;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BrowserScheduleCollisionRequestTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class'=> 'DatabaseSeeder']);
    }

    //Un usuario no puede no anexar la selcción de materias
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_subjects_selection_cannot_be_empty_Schedule_Collision()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 2,
            'confirmed' =>true
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
                    ->assertSee('Formulario para solicitar colisión de horarios')
                    ->attach('proof_notes',\Config::get('constants.proof_notes'))
                    ->attach('reason_letter',\Config::get('constants.reason_letter_Schedule_collision'))
                    ->attach('currently_schedule',\Config::get('constants.currently_schedule'))
                    ->press('#Enviar')
                    ->assertSee('Formulario para solicitar colisión de horarios')
                    ->assertUrlIs(route('request.schedule_collision',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]));

        });
    }

    //Un usuario no puede no anexar la constancia de notas
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_proof_notes_cannot_be_empty_Schedule_Collision()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 2,
            'confirmed' =>true
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
                    ->assertSee('Formulario para solicitar colisión de horarios')
                    ->attach('subjects_selection', \Config::get('constants.subjects_selection'))
                    ->attach('reason_letter',\Config::get('constants.reason_letter_Schedule_collision'))
                    ->attach('currently_schedule',\Config::get('constants.currently_schedule'))
                    ->press('#Enviar')
                    ->assertSee('Formulario para solicitar colisión de horarios')
                    ->assertUrlIs(route('request.schedule_collision',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]));

        });
    }

    //Un usuario no puede no anexar una carta de motivo
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_reason_letter_cannot_be_empty_Schedule_Collision()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 2,
            'confirmed' =>true
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
                    ->assertSee('Formulario para solicitar colisión de horarios')
                    ->attach('subjects_selection', \Config::get('constants.subjects_selection'))
                    ->attach('proof_notes',\Config::get('constants.proof_notes'))
                    ->attach('currently_schedule',\Config::get('constants.currently_schedule'))
                    ->press('#Enviar')
                    ->assertSee('Formulario para solicitar colisión de horarios')
                    ->assertUrlIs(route('request.schedule_collision',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]));

        });
    }

    //Un usuario no puede no anexar el horario actual
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_currently_schedule_cannot_be_empty_Schedule_Collision()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 2,
            'confirmed' =>true
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
                    ->assertSee('Formulario para solicitar colisión de horarios')
                    ->attach('subjects_selection', \Config::get('constants.subjects_selection'))
                    ->attach('proof_notes',\Config::get('constants.proof_notes'))
                    ->attach('reason_letter',\Config::get('constants.reason_letter_Schedule_collision'))
                    ->press('#Enviar')
                    ->assertSee('Formulario para solicitar colisión de horarios')
                    ->assertUrlIs(route('request.schedule_collision',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]));

        });
    }

    //Un usuario no puede anexar una selección de materia que no sea pdf
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_subjects_selection_cannot_be_not_PDF_Schedule_Collision()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 2,
            'confirmed' =>true
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
                    ->assertSee('Formulario para solicitar colisión de horarios')
                    ->attach('subjects_selection', \Config::get('constants.error_archive'))
                    ->attach('proof_notes',\Config::get('constants.proof_notes'))
                    ->attach('reason_letter',\Config::get('constants.reason_letter_Schedule_collision'))
                    ->attach('currently_schedule',\Config::get('constants.currently_schedule'))
                    ->press('#Enviar')
                    ->assertSee('subjects selection debe ser un archivo con formato: pdf.')
                    ->assertUrlIs(route('request.schedule_collision',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]));

        });
    }

    //Un usuario no puede anexar una constancia de notas que no sea pdf
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_proof_notes_cannot_be_not_PDF_Schedule_Collision()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 2,
            'confirmed' =>true
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
                    ->assertSee('Formulario para solicitar colisión de horarios')
                    ->attach('subjects_selection', \Config::get('constants.subjects_selection'))
                    ->attach('proof_notes',\Config::get('constants.error_archive'))
                    ->attach('reason_letter',\Config::get('constants.reason_letter_Schedule_collision'))
                    ->attach('currently_schedule',\Config::get('constants.currently_schedule'))
                    ->press('#Enviar')
                    ->assertSee('proof notes debe ser un archivo con formato: pdf.')
                    ->assertUrlIs(route('request.schedule_collision',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]));

        });
    }

    //Un usuario no puede anexar una carta de motivo que no sea pdf
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_reason_letter_cannot_be_not_PDF_Schedule_Collision()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 2,
            'confirmed' =>true
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
                    ->assertSee('Formulario para solicitar colisión de horarios')
                    ->attach('subjects_selection', \Config::get('constants.subjects_selection'))
                    ->attach('proof_notes',\Config::get('constants.proof_notes'))
                    ->attach('reason_letter',\Config::get('constants.error_archive'))
                    ->attach('currently_schedule',\Config::get('constants.currently_schedule'))
                    ->press('#Enviar')
                    ->assertSee('reason letter debe ser un archivo con formato: pdf.')
                    ->assertUrlIs(route('request.schedule_collision',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]));

        });
    }

    //Un usuario no puede anexar una carta de motivo que no sea pdf
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_currently_schedule_cannot_be_not_PDF_Schedule_Collision()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 2,
            'confirmed' =>true
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
                    ->assertSee('Formulario para solicitar colisión de horarios')
                    ->attach('subjects_selection', \Config::get('constants.subjects_selection'))
                    ->attach('proof_notes',\Config::get('constants.proof_notes'))
                    ->attach('reason_letter',\Config::get('constants.reason_letter_Schedule_collision'))
                    ->attach('currently_schedule',\Config::get('constants.error_archive'))
                    ->press('#Enviar')
                    ->assertSee('currently schedule debe ser un archivo con formato: pdf.')
                    ->assertUrlIs(route('request.schedule_collision',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]));

        });
    }

    //Un usuario puede anexar sus documentos correctamente
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function an_user_can_complete_Schedule_Collision_Request()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 2,
            'confirmed' =>true
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
                    ->assertSee('Formulario para solicitar colisión de horarios')
                    ->attach('subjects_selection', \Config::get('constants.subjects_selection'))
                    ->attach('proof_notes',\Config::get('constants.proof_notes'))
                    ->attach('reason_letter',\Config::get('constants.reason_letter_Schedule_collision'))
                    ->attach('currently_schedule',\Config::get('constants.currently_schedule'))
                    ->press('#Enviar')
                    ->assertSee('Petición completada con éxito')
                    ->assertUrlIs("http://tesis.test/");

        });
    }
}
