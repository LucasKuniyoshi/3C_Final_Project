<?php
namespace App\Console\Commands;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\File;

class MakeDomain extends Command
{
    protected $signature = 'make:domain {name}';
    protected $description = 'Cria um novo domínio dentro de app/Domains';

    public function handle()
    {
        $name = $this->argument('name');
        $domainPath = app_path("Domains/{$name}");

        // Estrutura de pastas
        $folders = [
            'Controllers',
            'Models',
            'Repositories/Contracts',
            'Services',
            'Requests',
        ];

        foreach ($folders as $folder) {
            $path = "{$domainPath}/{$folder}";
            if (!File::exists($path)) {
                File::makeDirectory($path, 0755, true);
            }
        }

        $this->info("Domínio {$name} criado com sucesso em app/Domains!");
    }
}
