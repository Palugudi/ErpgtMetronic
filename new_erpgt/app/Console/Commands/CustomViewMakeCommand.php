<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CustomViewMakeCommand extends GeneratorCommand
{
    protected $name = 'custom:view';

    protected $type = 'View';

    protected $description = 'Create a customized views.';

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
            ['view', InputArgument::REQUIRED, 'The view'],
        ];
    }

    protected function getViewInput()
    {
        return trim($this->argument('view'));
    }

    protected function getStub()
    {
        $view = $this->getViewInput();
        return __DIR__.'/stubs/view_'.$view.'.custom.stub';
    }

    protected function getPath($name)
    {
        $view = $this->getViewInput();
        return base_path().'/resources/views/pages/'.$name.'/'.$view.'.blade.php';
    }

    protected function alreadyExists($name)
    {
        return $this->files->exists($this->getPath($name));
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceCustom($stub, $name);
    }

    protected function replaceCustom(&$stub, $name)
    {
        $lower_name = strtolower($name);
        $lower_names = $lower_name.'s';
        $ucfirst_name = ucfirst($name);
        $ucfirst_names = $ucfirst_name.'s';

        $stub = str_replace('dummy', $lower_name, $stub);
        $stub = str_replace('dummies', $lower_names, $stub);
        $stub = str_replace('Dummy', $ucfirst_name, $stub);
        $stub = str_replace('Dummies', $ucfirst_names, $stub);

        return $stub;
    }

    public function fire()
    {

        $name = $this->getNameInput();
        $view = $this->getViewInput();

        $path = $this->getPath($name);

        if ($this->alreadyExists($name)) {
            $this->error($this->type.' already exists!');

            return false;
        }

        $this->makeDirectory($path);

        $this->files->put($path, $this->buildClass($name));

        $this->info($this->type.' created successfully.');
    }
}
