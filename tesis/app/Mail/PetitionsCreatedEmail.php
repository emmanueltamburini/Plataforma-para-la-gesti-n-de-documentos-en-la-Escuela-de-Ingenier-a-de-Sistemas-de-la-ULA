<?php

namespace App\Mail;


use Illuminate\Bus\Queueable;
use Illuminate\Mail\Mailable;
use Illuminate\Queue\SerializesModels;
use Illuminate\Contracts\Queue\ShouldQueue;
use App\User;
use App\Models\Petition;
use Illuminate\Support\Facades\Crypt;
use Illuminate\Database\Eloquent\Collection;
use DB;

class PetitionsCreatedEmail extends Mailable
{
    use Queueable, SerializesModels;

    public $petitions;

    public function __construct($petitions)
    {
        $this->petitions= $petitions;
    }

    public function build()
    {
        return $this->markdown('emails.petitions')
            ->subject('Peticiones pendientes por procesar de '.$this->petitions->first()->user()->get()[0]->name)
            ->with([
                'petitions' => $this->petitions,
            ]);
    }
}
