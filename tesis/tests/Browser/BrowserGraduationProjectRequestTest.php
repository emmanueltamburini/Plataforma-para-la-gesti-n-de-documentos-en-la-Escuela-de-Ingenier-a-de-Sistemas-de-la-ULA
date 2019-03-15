<?php

namespace Tests\Browser;

use App\User;
use App\Models\Petition;
use Tests\DuskTestCase;
use Laravel\Dusk\Browser;
use Faker\Factory as Faker;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Foundation\Testing\DatabaseMigrations;

class BrowserGraduationProjectRequestTest extends DuskTestCase
{
    use DatabaseMigrations;

    public function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class'=> 'DatabaseSeeder']);
    }

    //Un usuario no puede no anexar la carta de propuesta de grado
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_grade_project_proposal_letter_cannot_be_empty_Graduation_Project()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 4,
            'confirmed' =>true
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
                    ->assertSee('Formulario para proyecto de grado')
                    ->attach('grade_project_proposal',\Config::get('constants.grade_project_proposal'))
                    ->attach('description_proposal',\Config::get('constants.description_proposal_Schedule_collision'))
                    ->attach('letter_engagement',\Config::get('constants.letter_engagement'))
                    ->press('#Enviar')
                    ->assertSee('Formulario para proyecto de grado')
                    ->assertUrlIs(route('request.graduation_project',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]));

        });
    }

    //Un usuario no puede no anexar la propuesta de grado
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_grade_project_proposal_cannot_be_empty_Graduation_Project()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 4,
            'confirmed' =>true
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
                    ->assertSee('Formulario para proyecto de grado')
                    ->attach('grade_project_proposal_letter', \Config::get('constants.grade_project_proposal_letter'))
                    ->attach('description_proposal',\Config::get('constants.description_proposal_Schedule_collision'))
                    ->attach('letter_engagement',\Config::get('constants.letter_engagement'))
                    ->press('#Enviar')
                    ->assertSee('Formulario para proyecto de grado')
                    ->assertUrlIs(route('request.graduation_project',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]));

        });
    }

    //Un usuario no puede no anexar la descripcuón de la propuesta de grado
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_description_proposal_cannot_be_empty_Graduation_Project()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 4,
            'confirmed' =>true
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
                    ->assertSee('Formulario para proyecto de grado')
                    ->attach('grade_project_proposal_letter', \Config::get('constants.grade_project_proposal_letter'))
                    ->attach('grade_project_proposal',\Config::get('constants.grade_project_proposal'))
                    ->attach('letter_engagement',\Config::get('constants.letter_engagement'))
                    ->press('#Enviar')
                    ->assertSee('Formulario para proyecto de grado')
                    ->assertUrlIs(route('request.graduation_project',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]));

        });
    }

    //Un usuario no puede no anexar la carta de compromiso
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_letter_engagement_cannot_be_empty_Graduation_Project()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 4,
            'confirmed' =>true
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
                    ->assertSee('Formulario para proyecto de grado')
                    ->attach('grade_project_proposal_letter', \Config::get('constants.grade_project_proposal_letter'))
                    ->attach('grade_project_proposal',\Config::get('constants.grade_project_proposal'))
                    ->attach('description_proposal',\Config::get('constants.description_proposal_Schedule_collision'))
                    ->press('#Enviar')
                    ->assertSee('Formulario para proyecto de grado')
                    ->assertUrlIs(route('request.graduation_project',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]));

        });
    }

    //Un usuario no puede anexar la carta de propuesta de grado  que no sea pdf
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_grade_project_proposal_letter_cannot_be_not_PDF_Graduation_Project()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 4,
            'confirmed' =>true
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
                    ->assertSee('Formulario para proyecto de grado')
                    ->attach('grade_project_proposal_letter', \Config::get('constants.error_archive'))
                    ->attach('grade_project_proposal',\Config::get('constants.grade_project_proposal'))
                    ->attach('description_proposal',\Config::get('constants.description_proposal'))
                    ->attach('letter_engagement',\Config::get('constants.letter_engagement'))
                    ->press('#Enviar')
                    ->assertSee('grade project proposal letter debe ser un archivo con formato: pdf.')
                    ->assertUrlIs(route('request.graduation_project',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]));

        });
    }

    //Un usuario no puede anexar la propuesta de grado que no sea pdf
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_grade_project_proposal_cannot_be_not_PDF_Graduation_Project()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 4,
            'confirmed' =>true
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
                    ->assertSee('Formulario para proyecto de grado')
                    ->attach('grade_project_proposal_letter', \Config::get('constants.grade_project_proposal_letter'))
                    ->attach('grade_project_proposal',\Config::get('constants.error_archive'))
                    ->attach('description_proposal',\Config::get('constants.description_proposal'))
                    ->attach('letter_engagement',\Config::get('constants.letter_engagement'))
                    ->press('#Enviar')
                    ->assertSee('grade project proposal debe ser un archivo con formato: pdf.')
                    ->assertUrlIs(route('request.graduation_project',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]));

        });
    }

    //Un usuario no puede anexar la descripción de la propuesta de grado que no sea pdf
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_description_proposal_cannot_be_not_PDF_Graduation_Project()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 4,
            'confirmed' =>true
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
                    ->assertSee('Formulario para proyecto de grado')
                    ->attach('grade_project_proposal_letter', \Config::get('constants.grade_project_proposal_letter'))
                    ->attach('grade_project_proposal',\Config::get('constants.grade_project_proposal'))
                    ->attach('description_proposal',\Config::get('constants.error_archive'))
                    ->attach('letter_engagement',\Config::get('constants.letter_engagement'))
                    ->press('#Enviar')
                    ->assertSee('description proposal debe ser un archivo con formato: pdf.')
                    ->assertUrlIs(route('request.graduation_project',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]));

        });
    }

    //Un usuario no puede anexar la carte de compromiso que no sea pdf
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function a_letter_engagement_cannot_be_not_PDF_Graduation_Project()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 4,
            'confirmed' =>true
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
                    ->assertSee('Formulario para proyecto de grado')
                    ->attach('grade_project_proposal_letter', \Config::get('constants.grade_project_proposal_letter'))
                    ->attach('grade_project_proposal',\Config::get('constants.grade_project_proposal'))
                    ->attach('description_proposal',\Config::get('constants.description_proposal'))
                    ->attach('letter_engagement',\Config::get('constants.error_archive'))
                    ->press('#Enviar')
                    ->assertSee('letter engagement debe ser un archivo con formato: pdf.')
                    ->assertUrlIs(route('request.graduation_project',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]));

        });
    }

    //Un usuario puede anexar sus documentos correctamente
    /**
     * A Dusk test example.
     *
     * @test
     *@throws \Throwable
     */

    public function an_user_can_complete_Graduation_Project_Request()
    {
        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'area' => random_int(1,3)
        ]);
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'request_type' => 4,
            'confirmed' =>true
        ]);

        $this->browse(function (Browser $browser) use($user,$petition) {

            //Datos encriptados
            $ID_crypt= Crypt::encryptString($petition->id);
            $code_crypt=Crypt::encryptString($petition->confirmation_code);

            $browser->visit(route('request.verify',['ID'   =>  $ID_crypt,'code' =>  $code_crypt]))
                    ->assertSee('Formulario para proyecto de grado')
                    ->attach('grade_project_proposal_letter', \Config::get('constants.grade_project_proposal_letter'))
                    ->attach('grade_project_proposal',\Config::get('constants.grade_project_proposal'))
                    ->attach('description_proposal',\Config::get('constants.description_proposal'))
                    ->attach('letter_engagement',\Config::get('constants.letter_engagement'))
                    ->press('#Enviar')
                    ->assertSee('Petición completada con éxito')
                    ->assertUrlIs("http://tesis.test/");

        });
    }
}
