<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\User;
use App\Models\Partit;
use App\Mail\JornadaMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class EnviarJornadaManagers extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'jornada:enviar';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Envia un correu amb la jornada actual als managers';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $this->info('Cercant partits propers...');

        // Busquem partits futurs (per exemple, els de la pròxima setmana)
        $partits = Partit::with(['equipLocal', 'equipVisitant'])
            ->whereDate('data', '>=', Carbon::now())
            ->orderBy('data', 'asc')
            ->take(10) // Limitem per no enviar mil partits
            ->get();

        if ($partits->isEmpty()) {
            $this->warn('No hi ha partits programats properament.');
            return;
        }

        // Busquem tots els managers
        $managers = User::where('role', 'manager')->get();

        foreach ($managers as $manager) {
            Mail::to($manager->email)->send(new JornadaMail($partits));
            $this->info("Correu enviat a: {$manager->email}");
        }

        $this->info('Procés finalitzat correctament.');
    }
}