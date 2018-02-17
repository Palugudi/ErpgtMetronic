<?php

namespace App\Console\Commands;

use Illuminate\Support\Str;
use Illuminate\Console\GeneratorCommand;
use Symfony\Component\Console\Input\InputOption;
use Symfony\Component\Console\Input\InputArgument;

class CustomMigrationMakeCommand extends GeneratorCommand
{
    protected $name = 'custom:migration';

    protected $type = 'Migration';

    protected $description = 'Create a customized migration.';

    protected function getArguments()
    {
        return [
            ['name', InputArgument::REQUIRED, 'The name of the class'],
        ];
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/migration.custom.stub';
    }

    protected function getPath($name)
    {
        $lower_name = strtolower($name);
        $lower_names = $lower_name.'s';

        return base_path().'/database/migrations/' . date('Y_m_d_His') . '_create_' . $lower_names . '_table.php';
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
