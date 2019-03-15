<?php

namespace Tests\Feature;

use App\User;
use App\Models\Petition;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Crypt;
use Tests\TestCase;
use Illuminate\Foundation\Testing\WithFaker;
use Illuminate\Foundation\Testing\RefreshDatabase;

class GraduationProjectRequestTest extends TestCase
{
    use RefreshDatabase;

    //Carga lo seeders
    public function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class'=> 'DatabaseSeeder']);
    }

    //*****************************Test que prueba el usuario debe subir una carta de propuesta de grado********************************
    /** @test */
    public function a_grade_project_proposal_letter_cannot_be_empty_Graduation_Project()
    {
        //1. Given -> Teniendo un usuario con una petición
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'confirmed' => true,
        ]);

        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. When -> Cuando hacemos un post request
        $response = $this->post(route('request.graduation_project_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
            'grade_project_proposal_letter' => '',
        ]);

        //3. Then -> Entonces se consigue un error
        $response->assertSessionHasErrors('grade_project_proposal_letter');

    }
    //*****************************Test que prueba el usuario debe subir una propuesta de grado********************************
    /** @test */
    public function a_grade_project_proposal_cannot_be_empty_Graduation_Project()
    {
        //1. Given -> Teniendo un usuario con una petición
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'confirmed' => true,
        ]);

        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. When -> Cuando hacemos un post request
        $response = $this->post(route('request.graduation_project_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
            'grade_project_proposal' => '',
        ]);

        //3. Then -> Entonces se consigue un error
        $response->assertSessionHasErrors('grade_project_proposal');

    }

    //*****************************Test que prueba el usuario debe subir una descripción de la propuesta de grado********************************
    /** @test */
    public function a_description_proposal_cannot_be_empty_Graduation_Project()
    {
        //1. Given -> Teniendo un usuario con una petición
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'confirmed' => true,
        ]);

        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. When -> Cuando hacemos un post request
        $response = $this->post(route('request.graduation_project_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
            'description_proposal' => ''
        ]);

        //3. Then -> Entonces se consigue un error
        $response->assertSessionHasErrors('description_proposal');

    }

    //*****************************Test que prueba el usuario debe subir una carta de compromiso***********************************
    /** @test */
    public function a_letter_engagement_cannot_be_empty_Graduation_Project()
    {
        //1. Given -> Teniendo un usuario con una petición
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'confirmed' => true,
        ]);

        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. When -> Cuando hacemos un post request
        $response = $this->post(route('request.graduation_project_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
            'letter_engagement' => ''
        ]);

        //3. Then -> Entonces se consigue un error
        $response->assertSessionHasErrors('letter_engagement');

    }

    //*****************************Test que prueba que un usuario puede subir su  carta de proyecto de grado********************************
    /** @test */
    public function an_user_can_upload_grade_project_proposal_letter_Graduation_Project()
    {
        $this->withoutExceptionHandling();
        //Falso de depósito de archivos
        Storage::fake(\Config::get('constants.Disco_fake'));

        //1. Given -> Teniendo un usuario con una petición
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'confirmed' => true,
        ]);

        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. When -> Cuando hacemos un post request
        $response = $this->post(route('request.graduation_project_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
            'grade_project_proposal_letter' => UploadedFile::fake()->create('grade_project_proposal_letter.pdf'),
            'grade_project_proposal' => UploadedFile::fake()->create('grade_project_proposal.pdf'),
            'description_proposal' => UploadedFile::fake()->create('description_proposal.pdf'),
            'letter_engagement' => UploadedFile::fake()->create('letter_engagement.pdf')
        ]);

        $response->assertRedirect('/');

        //3. Then -> Entonces el archivo es guardado en disco correctamente
        Storage::disk(\Config::get('constants.Disco_fake'))->assertExists('grade_project_proposal_letter/ID_'.$petition->id."_CI_".$petition->ID_user."_carta_propuesta_proyecto_de_grado.pdf");

    }
    //*****************************Test que prueba que un usuario puede subir su proyecto de grado********************************
    /** @test */
    public function an_user_can_upload_grade_project_proposal_Graduation_Project()
    {

    	//Falso de depósito de archivos
        Storage::fake(\Config::get('constants.Disco_fake'));

        //1. Given -> Teniendo un usuario con una petición
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'confirmed' => true,
        ]);

        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. When -> Cuando hacemos un post request
        $response = $this->post(route('request.graduation_project_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
            'grade_project_proposal_letter' => UploadedFile::fake()->create('grade_project_proposal_letter.pdf'),
			'grade_project_proposal' => UploadedFile::fake()->create('grade_project_proposal.pdf'),
			'description_proposal' => UploadedFile::fake()->create('description_proposal.pdf'),
			'letter_engagement' => UploadedFile::fake()->create('letter_engagement.pdf')
        ]);

        $response->assertRedirect('/');

        //3. Then -> Entonces el archivo es guardado en disco correctamente
        Storage::disk(\Config::get('constants.Disco_fake'))->assertExists('grade_project_proposal/ID_'.$petition->id."_CI_".$petition->ID_user."_propuesta_proyecto_de_grado.pdf");

    }

    //*****************************Test que prueba que un usuario puede subir su descripción del proyecto de grado********************************
    /** @test */
    public function an_user_can_upload_description_proposal_Graduation_Project()
    {

    	//Falso de depósito de archivos
        Storage::fake(\Config::get('constants.Disco_fake'));

        //1. Given -> Teniendo un usuario con una petición
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'confirmed' => true,
        ]);

        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. When -> Cuando hacemos un post request
        $response = $this->post(route('request.graduation_project_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
            'grade_project_proposal_letter' => UploadedFile::fake()->create('grade_project_proposal_letter.pdf'),
            'grade_project_proposal' => UploadedFile::fake()->create('grade_project_proposal.pdf'),
            'description_proposal' => UploadedFile::fake()->create('description_proposal.pdf'),
            'letter_engagement' => UploadedFile::fake()->create('letter_engagement.pdf')
        ]);

        $response->assertRedirect('/');

        //3. Then -> Entonces el archivo es guardado en disco correctamente
        Storage::disk(\Config::get('constants.Disco_fake'))->assertExists('description_proposal/ID_'.$petition->id."_CI_".$petition->ID_user."_descripcion_propuesta.pdf");

    }

    //*****************************Test que prueba que un usuario puede subir su carta de compromiso*******************************
    /** @test */
    public function an_user_can_upload_letter_engagement_Graduation_Project()
    {

    	//Falso de depósito de archivos
        Storage::fake(\Config::get('constants.Disco_fake'));

        //1. Given -> Teniendo un usuario con una petición
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'confirmed' => true,
        ]);

        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. When -> Cuando hacemos un post request
        $response = $this->post(route('request.graduation_project_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
            'grade_project_proposal_letter' => UploadedFile::fake()->create('grade_project_proposal_letter.pdf'),
            'grade_project_proposal' => UploadedFile::fake()->create('grade_project_proposal.pdf'),
            'description_proposal' => UploadedFile::fake()->create('description_proposal.pdf'),
            'letter_engagement' => UploadedFile::fake()->create('letter_engagement.pdf')
        ]);

        $response->assertRedirect('/');

        //3. Then -> Entonces el archivo es guardado en disco correctamente
        Storage::disk(\Config::get('constants.Disco_fake'))->assertExists('letter_engagement/ID_'.$petition->id."_CI_".$petition->ID_user."_carta_de_compromiso.pdf");

    }

    //*****************************Test que prueba que la petición debe estar confirmada para poder ser actualizada*******************************
    /** @test */
    public function a_petition_must_be_confirmed_Graduation_Project()
    {

    	//Falso de depósito de archivos
        Storage::fake(\Config::get('constants.Disco_fake'));

        //1. Given -> Teniendo un usuario con una petición
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
        ]);

        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. When -> Cuando hacemos un post request
        $response = $this->post(route('request.graduation_project_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
            'grade_project_proposal_letter' => UploadedFile::fake()->create('grade_project_proposal_letter.pdf'),
            'grade_project_proposal' => UploadedFile::fake()->create('grade_project_proposal.pdf'),
            'description_proposal' => UploadedFile::fake()->create('description_proposal.pdf'),
            'letter_engagement' => UploadedFile::fake()->create('letter_engagement.pdf')
        ]);

        $response->assertRedirect('/');

        //3. Then -> Entonces los archivos no so guardado en disco correctamente
        Storage::disk(\Config::get('constants.Disco_fake'))->assertMissing('grade_project_proposal_letter/ID_'.$petition->id."_CI_".$petition->ID_user."_carta_propuesta_proyecto_de_grado.pdf");
        Storage::disk(\Config::get('constants.Disco_fake'))->assertMissing('grade_project_proposal/ID_'.$petition->id."_CI_".$petition->ID_user."_propuesta_proyecto_de_grado.pdf");
        Storage::disk(\Config::get('constants.Disco_fake'))->assertMissing('description_proposal/ID_'.$petition->id."_CI_".$petition->ID_user."_descripcion_propuesta.pdf");
        Storage::disk(\Config::get('constants.Disco_fake'))->assertMissing('letter_engagement/ID_'.$petition->id."_CI_".$petition->ID_user."_carta_de_compromiso.pdf");

    }
    //*****************************Test que prueba que se guarada el path de la carta proyecto de grado correctamente******************************
    /** @test */
    public function a_grade_project_proposal_letter_must_have_a_path_Graduation_Project()
    {

        //Falso de depósito de archivos
        Storage::fake(\Config::get('constants.Disco_fake'));

        //1. Given -> Teniendo un usuario con una petición
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'confirmed' => true,
        ]);

        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. When -> Cuando hacemos un post request
        $response = $this->post(route('request.graduation_project_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
            'grade_project_proposal_letter' => UploadedFile::fake()->create('grade_project_proposal_letter.pdf'),
            'grade_project_proposal' => UploadedFile::fake()->create('grade_project_proposal.pdf'),
            'description_proposal' => UploadedFile::fake()->create('description_proposal.pdf'),
            'letter_engagement' => UploadedFile::fake()->create('letter_engagement.pdf')
        ]);

        $response->assertRedirect('/');

        //Se busca la petición en base de datos
        $Petition = Petition::where([
          ['id', $petition->id],
          ['ID_user', $petition->ID_user]
        ])->first();

        //3. Then -> Entonces el path del archivo es guardado en disco correctamente
        $this->assertTrue(
            $Petition->collections[0]['grade_project_proposal_letter'] === 'grade_project_proposal_letter/ID_'.$petition->id."_CI_".$petition->ID_user."_carta_propuesta_proyecto_de_grado.pdf"
        );
    }

    //*****************************Test que prueba que se guarada el path del proyecto de grado correctamente******************************
    /** @test */
    public function a_grade_project_proposal_must_have_a_path_Graduation_Project()
    {

    	//Falso de depósito de archivos
        Storage::fake(\Config::get('constants.Disco_fake'));

        //1. Given -> Teniendo un usuario con una petición
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'confirmed' => true,
        ]);

        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. When -> Cuando hacemos un post request
        $response = $this->post(route('request.graduation_project_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
            'grade_project_proposal_letter' => UploadedFile::fake()->create('grade_project_proposal_letter.pdf'),
            'grade_project_proposal' => UploadedFile::fake()->create('grade_project_proposal.pdf'),
            'description_proposal' => UploadedFile::fake()->create('description_proposal.pdf'),
            'letter_engagement' => UploadedFile::fake()->create('letter_engagement.pdf')
        ]);

        $response->assertRedirect('/');

        //Se busca la petición en base de datos
        $Petition = Petition::where([
          ['id', $petition->id],
          ['ID_user', $petition->ID_user]
        ])->first();

        //3. Then -> Entonces el path del archivo es guardado en disco correctamente
		$this->assertTrue(
			$Petition->collections[1]['grade_project_proposal'] === 'grade_project_proposal/ID_'.$petition->id."_CI_".$petition->ID_user."_propuesta_proyecto_de_grado.pdf"
		);
    }

   //***************************Test que prueba que se guarada el path de la descripción del proyecto de grado*******************************
    /** @test */
    public function a_description_proposal_selection_must_have_a_path_Graduation_Project()
    {

    	//Falso de depósito de archivos
        Storage::fake(\Config::get('constants.Disco_fake'));

        //1. Given -> Teniendo un usuario con una petición
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'confirmed' => true,
        ]);

        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. When -> Cuando hacemos un post request
        $response = $this->post(route('request.graduation_project_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
            'grade_project_proposal_letter' => UploadedFile::fake()->create('grade_project_proposal_letter.pdf'),
            'grade_project_proposal' => UploadedFile::fake()->create('grade_project_proposal.pdf'),
            'description_proposal' => UploadedFile::fake()->create('description_proposal.pdf'),
            'letter_engagement' => UploadedFile::fake()->create('letter_engagement.pdf')
        ]);

        $response->assertRedirect('/');

		//Se busca la petición en base de datos
        $Petition = Petition::where([
          ['id', $petition->id],
          ['ID_user', $petition->ID_user]
        ])->first();

        //3. Then -> Entonces el path del archivo es guardado en disco correctamente
		$this->assertTrue(
			$Petition->collections[2]['description_proposal'] === 'description_proposal/ID_'.$petition->id."_CI_".$petition->ID_user."_descripcion_propuesta.pdf"
		);
    }

    //*****************************Test que prueba que se guarda el path de la carta de compromiso******************************
    /** @test */
    public function a_letter_engagement_must_have_a_path_Graduation_Project()
    {

    	//Falso de depósito de archivos
        Storage::fake(\Config::get('constants.Disco_fake'));

        //1. Given -> Teniendo un usuario con una petición
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'confirmed' => true,
        ]);

        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. When -> Cuando hacemos un post request
        $response = $this->post(route('request.graduation_project_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
            'grade_project_proposal_letter' => UploadedFile::fake()->create('grade_project_proposal_letter.pdf'),
            'grade_project_proposal' => UploadedFile::fake()->create('grade_project_proposal.pdf'),
            'description_proposal' => UploadedFile::fake()->create('description_proposal.pdf'),
            'letter_engagement' => UploadedFile::fake()->create('letter_engagement.pdf')
        ]);

        $response->assertRedirect('/');

        //Se busca la petición en base de datos
        $Petition = Petition::where([
          ['id', $petition->id],
          ['ID_user', $petition->ID_user]
        ])->first();

        //3. Then -> Entonces el path del archivo es guardado en disco correctamente
		$this->assertTrue(
			$Petition->collections[3]['letter_engagement'] === 'letter_engagement/ID_'.$petition->id."_CI_".$petition->ID_user."_carta_de_compromiso.pdf"
		);
    }

    //*****************************Test que prueba que una petición terminada no tiene código de verificación******************************
    /** @test */
    public function a_request_finished_dont_have_confirmation_code_Graduation_Project()
    {

    	//Falso de depósito de archivos
        Storage::fake(\Config::get('constants.Disco_fake'));

        //1. Given -> Teniendo un usuario con una petición
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'confirmed' => true,
        ]);

        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. When -> Cuando hacemos un post request
        $response = $this->post(route('request.graduation_project_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
            'grade_project_proposal_letter' => UploadedFile::fake()->create('grade_project_proposal_letter.pdf'),
            'grade_project_proposal' => UploadedFile::fake()->create('grade_project_proposal.pdf'),
            'description_proposal' => UploadedFile::fake()->create('description_proposal.pdf'),
            'letter_engagement' => UploadedFile::fake()->create('letter_engagement.pdf')
        ]);

        $response->assertRedirect('/');

        //3. Then -> Entonces el path del archivo es guardado en disco correctamente
        $this->assertDatabaseHas('petitions',[
        	'id' => $petition->id,
            'ID_user' => $petition->ID_user,
            'confirmation_code' => null
        ]);
    }

     //***********************************************Test que prueba el mensaje de la petición***************************************************
    /** @test */
    public function an_info_in_a_finished_petition_is_coherence_Graduation_Project()
    {
    	//Falso de depósito de archivos
        Storage::fake(\Config::get('constants.Disco_fake'));

        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'confirmed' => true,
            'info' => 'Esperando por recaudos',
        ]);

        //2. When -> Cuando hacemos un post request
        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. Then -> Usuario utiliza el link del correo
        $response = $this->post(route('request.graduation_project_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
            'grade_project_proposal_letter' => UploadedFile::fake()->create('grade_project_proposal_letter.pdf'),
            'grade_project_proposal' => UploadedFile::fake()->create('grade_project_proposal.pdf'),
            'description_proposal' => UploadedFile::fake()->create('description_proposal.pdf'),
            'letter_engagement' => UploadedFile::fake()->create('letter_engagement.pdf')
        ]);

        //3. Then -> Entonces la info de la petición va de acuerdo a su estado
        $this->assertDatabaseHas('petitions',[
            'ID_user' => $petition->ID_user,
            'id' => $petition->id,
            'info' => 'Esperando por respuesta',
        ]);
    }

     //************************************Test que prueba mensaje de éxito al enviar petición*************************************************************
    /** @test */
    public function a_successful_Graduation_Project_petition_send_a_successful_message()
    {
        //Falso de depósito de archivos
        Storage::fake(\Config::get('constants.Disco_fake'));

        //1. Given -> Teniendo un usuario con una petición
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'confirmed' => true,
        ]);

        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. When -> Cuando hacemos un post request
        $response = $this->post(route('request.graduation_project_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
            'grade_project_proposal_letter' => UploadedFile::fake()->create('grade_project_proposal_letter.pdf'),
            'grade_project_proposal' => UploadedFile::fake()->create('grade_project_proposal.pdf'),
            'description_proposal' => UploadedFile::fake()->create('description_proposal.pdf'),
            'letter_engagement' => UploadedFile::fake()->create('letter_engagement.pdf')
        ]);

        $response->assertRedirect('/');

        //3. Then -> Entonces veo que se envía el mensaje de confirmación
        $response->assertSessionHas("status-check");

    }

     //****************************Test que prueba mensaje de fracaso al enviar petición no verificada****************************************************
    /** @test */
    public function a_no_verified_Graduation_Project_petition_send_a_danger_message()
    {
        //Falso de depósito de archivos
        Storage::fake(\Config::get('constants.Disco_fake'));

        //1. Given -> Teniendo un usuario con una petición
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
        ]);

        //Datos encriptados
        $ID_crypt= Crypt::encryptString($petition->id);
        $code_crypt=Crypt::encryptString($petition->confirmation_code);

        //2. When -> Cuando hacemos un post request
        $response = $this->post(route('request.graduation_project_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
            'grade_project_proposal_letter' => UploadedFile::fake()->create('grade_project_proposal_letter.pdf'),
            'grade_project_proposal' => UploadedFile::fake()->create('grade_project_proposal.pdf'),
            'description_proposal' => UploadedFile::fake()->create('description_proposal.pdf'),
            'letter_engagement' => UploadedFile::fake()->create('letter_engagement.pdf')
        ]);

        $response->assertRedirect('/');

        //3. Then -> Entonces la sección marca error
        $response->assertSessionHas("status-danger");

    }
}
