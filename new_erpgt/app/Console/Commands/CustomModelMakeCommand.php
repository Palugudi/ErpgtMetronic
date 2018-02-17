<?php
namespace App\Console\Commands;

use Illuminate\Foundation\Console\ModelMakeCommand;

class CustomModelMakeCommand extends ModelMakeCommand {

    protected $name = 'custom:model';

    protected $description = 'Create a customized model.';

    public function fire()
    {
        if (parent::fire() === false) {
            return;
        }
    }

    protected function getPath($name)
    {
        $name = str_replace_first($this->laravel->getNamespace(), '', $name);

        return $this->laravel['path'].'/Models/'.str_replace('\\', '/', $name).'.php';
    }

    protected function getStub()
    {
        return __DIR__.'/stubs/model.custom.stub';
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)->replaceCustom($stub)->replaceClass($stub, $name);
    }

    protected function replaceCustom(&$stub)
    {
        $name = $this->getNameInput();

        $lower_name = strtolower(str_replace('\\', '.', $name));
        $lower_names = $lower_name.'s';
        $ucfirst_name = ucfirst($name);
        $ucfirst_names = $ucfirst_name.'s';

        $stub = str_replace('dummy', $lower_name, $stub);
        $stub = str_replace('dummies', $lower_names, $stub);
        $stub = str_replace('Dummy', $ucfirst_name, $stub);
        $stub = str_replace('Dummies', $ucfirst_names, $stub);

        return $this;
    }
}