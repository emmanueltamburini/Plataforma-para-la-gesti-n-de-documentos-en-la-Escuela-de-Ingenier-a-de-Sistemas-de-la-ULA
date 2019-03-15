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


class ParallelRequestTest extends TestCase
{
    use RefreshDatabase;

    //Carga lo seeders
    public function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class'=> 'DatabaseSeeder']);
    }

    //*****************************Test que prueba el usuario debe subir una selección de materia********************************
    /** @test */
    public function a_subjects_selection_cannot_be_empty_Parallel()
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
        $response = $this->post(route('request.parallel_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
            'subjects_selection' => '',
        ]);

        //3. Then -> Entonces se consigue un error
        $response->assertSessionHasErrors('subjects_selection');

    }

    //*****************************Test que prueba el usuario debe subir una constacia de notas********************************
    /** @test */
    public function a_proof_notes_cannot_be_empty_Parallel()
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
        $response = $this->post(route('request.parallel_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
            'proof_notes' => ''
        ]);

        //3. Then -> Entonces se consigue un error
        $response->assertSessionHasErrors('proof_notes');

    }

    //*****************************Test que prueba el usuario debe subir carta de motivo***********************************
    /** @test */
    public function a_reason_letter_cannot_be_empty_Parallel()
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
        $response = $this->post(route('request.parallel_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
            'reason_letter' => ''
        ]);

        //3. Then -> Entonces se consigue un error
        $response->assertSessionHasErrors('reason_letter');

    }
    //*****************************Test que prueba que un usuario puede subir su selección de materias al sistema********************************
    /** @test */
    public function an_user_can_upload_subjects_selection_Parallel()
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
        $response = $this->post(route('request.parallel_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
			'subjects_selection' => UploadedFile::fake()->create('subjects_selection.pdf'),
			'proof_notes' => UploadedFile::fake()->create('proof_notes.pdf'),
			'reason_letter' => UploadedFile::fake()->create('reason_letter.pdf')
        ]);

        $response->assertRedirect('/');

        //3. Then -> Entonces el archivo es guardado en disco correctamente
        Storage::disk(\Config::get('constants.Disco_fake'))->assertExists('subjects_selection/ID_'.$petition->id."_CI_".$petition->ID_user."_seleccion_de_materias.pdf");

    }

    //*****************************Test que prueba que un usuario puede subir su constancia de notas al sistema********************************
    /** @test */
    public function an_user_can_upload_proof_notes_Parallel()
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
        $response = $this->post(route('request.parallel_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
			'subjects_selection' => UploadedFile::fake()->create('subjects_selection.pdf'),
			'proof_notes' => UploadedFile::fake()->create('proof_notes.pdf'),
			'reason_letter' => UploadedFile::fake()->create('reason_letter.pdf')
        ]);

        $response->assertRedirect('/');

        //3. Then -> Entonces el archivo es guardado en disco correctamente
        Storage::disk(\Config::get('constants.Disco_fake'))->assertExists('proof_notes/ID_'.$petition->id."_CI_".$petition->ID_user."_constancia_de_notas.pdf");

    }

    //*****************************Test que prueba que un usuario puede subir su carta con motivo al sistema*******************************
    /** @test */
    public function an_user_can_upload_reason_letter_Parallel()
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
        $response = $this->post(route('request.parallel_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
			'subjects_selection' => UploadedFile::fake()->create('subjects_selection.pdf'),
			'proof_notes' => UploadedFile::fake()->create('proof_notes.pdf'),
			'reason_letter' => UploadedFile::fake()->create('reason_letter.pdf')
        ]);

        $response->assertRedirect('/');

        //3. Then -> Entonces el archivo es guardado en disco correctamente
        Storage::disk(\Config::get('constants.Disco_fake'))->assertExists('reason_letter/ID_'.$petition->id."_CI_".$petition->ID_user."_carta_de_motivo.pdf");

    }

    //*****************************Test que prueba que la petición debe estar confirmada para poder ser actualizada*******************************
    /** @test */
    public function a_petition_must_be_confirmed_Parallel()
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
        $response = $this->post(route('request.parallel_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
			'subjects_selection' => UploadedFile::fake()->create('subjects_selection.pdf'),
			'proof_notes' => UploadedFile::fake()->create('proof_notes.pdf'),
			'reason_letter' => UploadedFile::fake()->create('reason_letter.pdf')
        ]);

        $response->assertRedirect('/');

        //3. Then -> Entonces el archivo es guardado en disco correctamente
        Storage::disk(\Config::get('constants.Disco_fake'))->assertMissing('subjects_selection/ID_'.$petition->id."_CI_".$petition->ID_user."_seleccion_de_materias.pdf");
        Storage::disk(\Config::get('constants.Disco_fake'))->assertMissing('proof_notes/ID_'.$petition->id."_CI_".$petition->ID_user."_constancia_de_notas.pdf");
        Storage::disk(\Config::get('constants.Disco_fake'))->assertMissing('reason_letter/ID_'.$petition->id."_CI_".$petition->ID_user."_carta_de_motivo.pdf");

    }

    //*****************************Test que prueba que se guarada el path de la selección de materias correctamente******************************
    /** @test */
    public function a_subjects_selection_must_have_a_path_Parallel()
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
        $response = $this->post(route('request.parallel_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
			'subjects_selection' => UploadedFile::fake()->create('subjects_selection.pdf'),
			'proof_notes' => UploadedFile::fake()->create('proof_notes.pdf'),
			'reason_letter' => UploadedFile::fake()->create('reason_letter.pdf')
        ]);

        $response->assertRedirect('/');

        //Se busca la petición en base de datos
        $Petition = Petition::where([
          ['id', $petition->id],
          ['ID_user', $petition->ID_user]
        ])->first();

        //3. Then -> Entonces el path del archivo es guardado en disco correctamente
		$this->assertTrue(
			$Petition->collections[0]['subjects_selection'] === 'subjects_selection/ID_'.$petition->id."_CI_".$petition->ID_user."_seleccion_de_materias.pdf"
		);
    }

   //***************************Test que prueba que se guarada el path de la constancia de notas correctamente********************************
    /** @test */
    public function a_proof_notes_selection_must_have_a_path_Parallel()
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
        $response = $this->post(route('request.parallel_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
			'subjects_selection' => UploadedFile::fake()->create('subjects_selection.pdf'),
			'proof_notes' => UploadedFile::fake()->create('proof_notes.pdf'),
			'reason_letter' => UploadedFile::fake()->create('reason_letter.pdf')
        ]);

        $response->assertRedirect('/');

		//Se busca la petición en base de datos
        $Petition = Petition::where([
          ['id', $petition->id],
          ['ID_user', $petition->ID_user]
        ])->first();

        //3. Then -> Entonces el path del archivo es guardado en disco correctamente
		$this->assertTrue(
			$Petition->collections[1]['proof_notes'] === 'proof_notes/ID_'.$petition->id."_CI_".$petition->ID_user."_constancia_de_notas.pdf"
		);
    }

    //*****************************Test que prueba que se guarada el path de la carta de motivo correctamente******************************
    /** @test */
    public function a_reason_letter_must_have_a_path_Parallel()
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
        $response = $this->post(route('request.parallel_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
			'subjects_selection' => UploadedFile::fake()->create('subjects_selection.pdf'),
			'proof_notes' => UploadedFile::fake()->create('proof_notes.pdf'),
			'reason_letter' => UploadedFile::fake()->create('reason_letter.pdf')
        ]);

        $response->assertRedirect('/');

        //Se busca la petición en base de datos
        $Petition = Petition::where([
          ['id', $petition->id],
          ['ID_user', $petition->ID_user]
        ])->first();

        //3. Then -> Entonces el path del archivo es guardado en disco correctamente
		$this->assertTrue(
			$Petition->collections[2]['reason_letter'] === 'reason_letter/ID_'.$petition->id."_CI_".$petition->ID_user."_carta_de_motivo.pdf"
		);
    }

        //*****************************Test que prueba que se guarada el path de la carta de motivo correctamente******************************
    /** @test */
    public function a_request_finished_dont_have_confirmation_code_Parallel()
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
        $response = $this->post(route('request.parallel_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
			'subjects_selection' => UploadedFile::fake()->create('subjects_selection.pdf'),
			'proof_notes' => UploadedFile::fake()->create('proof_notes.pdf'),
			'reason_letter' => UploadedFile::fake()->create('reason_letter.pdf')
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
    public function an_info_in_a_finished_petition_is_coherence_Parallel()
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
        $response = $this->post(route('request.parallel_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
			'subjects_selection' => UploadedFile::fake()->create('subjects_selection.pdf'),
			'proof_notes' => UploadedFile::fake()->create('proof_notes.pdf'),
			'reason_letter' => UploadedFile::fake()->create('reason_letter.pdf')
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
    public function a_successful_Parallel_petition_send_a_successful_message()
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
        $response = $this->post(route('request.parallel_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
            'subjects_selection' => UploadedFile::fake()->create('subjects_selection.pdf'),
            'proof_notes' => UploadedFile::fake()->create('proof_notes.pdf'),
            'reason_letter' => UploadedFile::fake()->create('reason_letter.pdf')
        ]);

        $response->assertRedirect('/');
        //3. Then -> Entonces veo que se envía el mensaje de confirmación
        $response->assertSessionHas("status-check");

    }

     //****************************Test que prueba mensaje de fracaso al enviar petición no verificada****************************************************
    /** @test */
    public function a_no_verified_Parallel_petition_send_a_danger_message()
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
        $response = $this->post(route('request.parallel_post',[
            'ID'   =>  $ID_crypt,
            'code' =>  $code_crypt,
        ]) ,[
            'subjects_selection' => UploadedFile::fake()->create('subjects_selection.pdf'),
            'proof_notes' => UploadedFile::fake()->create('proof_notes.pdf'),
            'reason_letter' => UploadedFile::fake()->create('reason_letter.pdf')
        ]);

        $response->assertRedirect('/');

        //3. Then -> Entonces la sección marca error
        $response->assertSessionHas("status-danger");

    }
}
