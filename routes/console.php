<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use Illuminate\Support\Facades\Schedule;
use App\Jobs\RelatorioPedidosJob;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

/*
|--------------------------------------------------------------------------
| Console Routes
|--------------------------------------------------------------------------
| Aqui definimos comandos e agendamentos no Laravel 12
*/

// Agendamento do relatório diário
Schedule::job(new RelatorioPedidosJob)
    ->dailyAt('08:00');