<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Models\Petition;
use Illuminate\Support\Facades\Crypt;
use DB;

class UserCreatedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $user,$petition;

    public function __construct(User $user,Petition $petition)
    {
        $this->petition= $petition;
        $this->user = $user;
    }

    public function build()
    {
        return $this->markdown('emails.verificacion')
            ->subject('¡Bienvenido '.$this->user->name.'! Verificación de peteción para '.$this->petition->request_type()->get()[0]->info)
            ->with([
                'name' => $this->user->name,
                'ID' => $this->user->ID,
                'id_petition' => Crypt::encryptString($this->petition->id),
                'email' => $this->petition->email,
                'request_type' =>  $this->petition->request_type()->get()[0]->info,
                'confirmation_code'  => Crypt::encryptString($this->petition->confirmation_code)
            ]);
    }
}
