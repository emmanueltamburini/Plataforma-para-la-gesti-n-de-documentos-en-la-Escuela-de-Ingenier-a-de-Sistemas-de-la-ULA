<?php

namespace Tests\Feature;

use Tests\TestCase;
use App\Mail\UserCreatedEmail;
use App\Mail\PetitionsCreatedEmail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Foundation\Testing\WithoutMiddleware;
use Illuminate\Foundation\Testing\DatabaseMigrations;
use Illuminate\Foundation\Testing\DatabaseTransactions;
use App\User;
use App\Models\Petition;

class SendVeriricarionEmailTest extends TestCase
{
    use DatabaseMigrations;
    use DatabaseTransactions;

    //Carga lo seeders
    public function setUp()
    {
        parent::setUp();
        $this->artisan('db:seed', ['--class'=> 'DatabaseSeeder']);
    }

    //************************************Test que prueba el destinatario del correo ************************************
    /** @test */
    public function destinatary_email_verification_is_good()
    {
        //Se usa para fngir envío de correo
        Mail::fake();
        $this->withoutMiddleware();

        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create();
        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
        ]);

        //2. When -> Se envía un correo a dicho usuario
        Mail::to($user)->send(new UserCreatedEmail($user,$petition));

        //3. Then -> Entonces el coreo destinatario es el mismo que el ingresado por el usuario
        Mail::assertSent(UserCreatedEmail::class, function ($mail) use ($user,$petition) {
            return $mail->to[0]['address'] === $user['email'];
        });
    }

    //************************************Test que prueba el nombre del destinatario del correo ***********************************
    /** @test */
    public function name_email_verification_is_good()
    {
        //Se usa para fngir envío de correo
        Mail::fake();
        $this->withoutMiddleware();

        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create();

        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
        ]);

        //2. When -> Se envía un correo a dicho usuario
        Mail::to($user)->send(new UserCreatedEmail($user,$petition));

        //3. Then -> Entonces el nombre del correo es el mismo que el del destinatario
        Mail::assertSent(UserCreatedEmail::class, function ($mail) use ($user,$petition) {
            return $mail->to[0]['name'] === $user['name'];
        });
    }

    //*********************************Test que prueba la cédula del destinario del correo **********************************
    /** @test */
    public function ID_email_verification_is_good()
    {
        //Se usa para fngir envío de correo
        Mail::fake();
        $this->withoutMiddleware();

        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'email' => "emmanueltamburini@gmail.com",
        ]);

        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
        ]);

        //2. When -> Se envía un correo a dicho usuario
        Mail::to($user)->send(new UserCreatedEmail($user,$petition));

        //3. Then -> Entonces la CI del correo es el mismo que el del destinatario
        Mail::assertSent(UserCreatedEmail::class, function ($mail) use ($user,$petition) {
            return $mail->user->ID === $user['ID'];
        });

    }

    //*********************************Test que prueba el tipo de solicitud del destinario del correo *********************************
    /** @test */
    public function request_type_email_verification_is_good()
    {
        //Se usa para fngir envío de correo
        Mail::fake();
        $this->withoutMiddleware();

        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'email' => "emmanueltamburini@gmail.com",
        ]);

        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
        ]);

        //2. When -> Se envía un correo a dicho usuario
        Mail::to($user)->send(new UserCreatedEmail($user,$petition));

        //3. Then -> Entonces la el tipo de solicitud del correo es el mismo que el del destinatario
        Mail::assertSent(UserCreatedEmail::class, function ($mail) use ($user,$petition) {
            return $mail->petition->request_type === $petition['request_type'];
        });

    }

    //******************************Test que prueba el códifo de confiramción del destinario del correo *******************************
    /** @test */
    public function confirmation_code_email_verification_is_good()
    {
        //Se usa para fngir envío de correo
        Mail::fake();
        $this->withoutMiddleware();

        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'email' => "emmanueltamburini@gmail.com",
        ]);

        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
        ]);

        //2. When -> Se envía un correo a dicho usuario
        Mail::to($user)->send(new UserCreatedEmail($user,$petition));

        //3. Then -> Entonces la el tipo de solicitud del correo es el mismo que el del destinatario
        Mail::assertSent(UserCreatedEmail::class, function ($mail) use ($user,$petition) {
            return $mail->petition->confirmation_code === $petition['confirmation_code'];
        });

    }

    //************************************Test que prueba el envío correcto del correo de verificación************************************
    /** @test */
    public function send_email_verification()
    {
        //Se usa para fngir envío de correo
        Mail::fake();
        $this->withoutMiddleware();

        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'email' => "emmanueltamburini@gmail.com",
        ]);

        $petition = factory(Petition::class)->create([
            'ID_user' => $user->ID,
        ]);

        //2. When -> Se envía un correo a dicho usuario
        Mail::to($user)->send(new UserCreatedEmail($user,$petition));

        // 3. Then -> Entonces el coreo fue enviado con éxito
        Mail::assertSent(UserCreatedEmail::class, function ($mail) use ($user,$petition) {
            return $mail->to[0]['address'] === $user['email'] and
            $mail->to[0]['name'] === $user['name'] and
            $mail->user->ID === $user['ID'] and
            $mail->petition->request_type === $petition['request_type'] and
            $mail->petition->confirmation_code === $petition['confirmation_code'];
        });

    }

    //************************************Test que prueba el nombre del destinatario ************************************
    /** @test */
    public function name_email_petitions_is_good()
    {
        //Se usa para fngir envío de correo
        Mail::fake();
        $this->withoutMiddleware();

        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'email' => "emmanueltamburini@gmail.com",
        ]);

        $petition= factory(Petition::class)->create([
            'ID_user' => $user->ID,
        ]);

        //2. When -> Se envía un correo a dicho usuario
        Mail::to($user)->send(new PetitionsCreatedEmail($user->petitions()->get()));

        // 3. Then -> Entonces el coreo fue enviado con éxito
        Mail::assertSent(PetitionsCreatedEmail::class, function ($mail) use ($user) {
            return $mail->to[0]['name'];
        });
    }

    //************************************Test que prueba el email del destinatario ************************************
    /** @test */
    public function destinatary_email_petitions_is_good()
    {
        //Se usa para fngir envío de correo
        Mail::fake();
        $this->withoutMiddleware();

        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'email' => "emmanueltamburini@gmail.com",
        ]);

        $petition= factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'info' => "Hola"
        ]);

        //2. When -> Se envía un correo a dicho usuario
        Mail::to($user)->send(new PetitionsCreatedEmail($user->petitions()->get()));

        // 3. Then -> Entonces el coreo fue enviado con éxito
        Mail::assertSent(PetitionsCreatedEmail::class, function ($mail) use ($user) {
            return $mail->to[0]['address'] == $user['email'];
        });
    }

    //************************************Test que prueba las peticiones del destinatario ************************************
    /** @test */
    public function petitions_email_petitons_is_good()
    {
        //Se usa para fngir envío de correo
        Mail::fake();
        $this->withoutMiddleware();

        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'email' => "emmanueltamburini@gmail.com",
        ]);

        $petition= factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'info' => "Hola"
        ]);

        //2. When -> Se envía un correo a dicho usuario
        Mail::to($user)->send(new PetitionsCreatedEmail($user->petitions()->get()));

        // 3. Then -> Entonces el coreo fue enviado con éxito
        Mail::assertSent(PetitionsCreatedEmail::class, function ($mail) use ($user) {
            return $mail->petitions == $user->petitions()->get();
        });
    }

    //************************************Test que prueba el envío del correo del destinatario***********************************
    /** @test */
    public function send_email_petitions()
    {
        //Se usa para fngir envío de correo
        Mail::fake();
        $this->withoutMiddleware();

        //1. Given -> Teniendo un usuario
        $user = factory(User::class)->create([
            'email' => "emmanueltamburini@gmail.com",
        ]);

        $petition= factory(Petition::class)->create([
            'ID_user' => $user->ID,
            'info' => "Hola"
        ]);

        //2. When -> Se envía un correo a dicho usuario
        Mail::to($user)->send(new PetitionsCreatedEmail($user->petitions()->get()));

        // 3. Then -> Entonces el coreo fue enviado con éxito
        Mail::assertSent(PetitionsCreatedEmail::class, function ($mail) use ($user) {
            return $mail->to[0]['name'] and
            $mail->to[0]['address'] == $user['email'] and
            $mail->petitions == $user->petitions()->get();
        });
    }

}
