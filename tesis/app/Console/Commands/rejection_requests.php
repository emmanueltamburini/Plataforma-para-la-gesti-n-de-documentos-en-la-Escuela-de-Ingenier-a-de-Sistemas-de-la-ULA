<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Petition;

class rejection_requests extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'rejection_requests';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Se encarga de marcar como rechazada todas las solicitudes a determianda hora';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {

            Petition::where([
              ['status', 2],
              ['info', 'Esperando confirmación de correo']
            ])->update([
              'confirmed' => false,
              'info' => 'La petición ha caducado, se recomienda realizar una nueva',
              'confirmation_code' => null,
              'status' => 1,
            ]);
    }
}
