<?php
namespace App\Console\Commands;

use Illuminate\Routing\Console\ControllerMakeCommand;

class CustomControllerMakeCommand extends ControllerMakeCommand {

    protected $name = 'custom:controller';

    protected $description = 'Create a customized controller.';

    protected function getStub()
    {
        return __DIR__.'/stubs/controller.custom.stub';
    }

    protected function buildClass($name)
    {
        $stub = $this->files->get($this->getStub());

        return $this->replaceNamespace($stub, $name)->replaceCustom($stub)->replaceClass($stub, $name);
    }

    protected function replaceCustom(&$stub)
    {
        $name = str_replace('Controller', '', $this->getNameInput());

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