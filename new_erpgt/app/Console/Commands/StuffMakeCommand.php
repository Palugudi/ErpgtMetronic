<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;

class StuffMakeCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'stuff:generate';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Create model, controller, request, views and js';

    /**
     * Execute the console command.
     *
     * @return mixed
     */
    public function handle()
    {
        $name = $this->ask('Model name ?');

        $model = ucfirst($name);
        $controller = ucfirst($name);
        $request = ucfirst($name);
        $migration = $name;
        $folder = strtolower($name);

        $this->call('custom:controller', [
            'name' => "{$controller}Controller",
        ]);

        $this->call('custom:model', [
            'name' => "{$model}",
        ]);

        $this->call('custom:request', [
            'name' => "{$request}Request",
        ]);

        $this->call('custom:migration', [
            'name' => "{$migration}",
        ]);

        $views = ['index'];
        foreach ($views as $view) {
            $this->call('custom:js', [
                'name' => "{$folder}",
                'view' => "{$view}"
            ]);
        }

        $views = ['index','listajax','modal'];
        foreach ($views as $view) {
            $this->call('custom:view', [
                'name' => "{$folder}",
                'view' => "{$view}"
            ]);
        }

        $langs = ['en','fr'];
        foreach ($langs as $lang) {
            $this->call('custom:lang', [
                'name' => "{$folder}",
                'lang' => "{$lang}"
            ]);
        }
    }
}
