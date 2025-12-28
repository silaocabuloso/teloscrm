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
| Console Routes (Laravel 12)
|--------------------------------------------------------------------------
| Aqui definimos comandos e agendamentos (Scheduler)
|
| IMPORTANTE:
| - O Scheduler NÃO deve despachar Job para fila nesse caso
| - Executamos o Job diretamente para garantir execução confiável
*/

// Relatório diário de pedidos — todos os dias às 08:00 (horário de Brasília)
Schedule::call(function () {
    // Executa o Job diretamente (sem fila)
    (new RelatorioPedidosJob)->handle();
})
//->dailyAt('08:00')
->everyMinute()
->timezone('America/Sao_Paulo');
