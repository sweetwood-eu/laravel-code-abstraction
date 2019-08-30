<?php


namespace SweetwoodEU\Laravel\CodeAbstraction\Console\Command;

use Illuminate\Console\GeneratorCommand as BaseGeneratorCommand;
use Illuminate\Filesystem\Filesystem;
use Illuminate\Support\Str;

abstract class GeneratorCommand extends BaseGeneratorCommand
{
    protected function getStub()
    {
        $type = Str::slug($this->type);
        return __DIR__ . "/stubs/{$type}.stub";
    }

    protected function getNameInput()
    {
        $name = parent::getNameInput();
        if (!Str::endsWith($name, $this->type)) {
            $name .= $this->type;
        }
        return Str::studly($name);
    }

    protected function getDefaultNamespace($rootNamespace)
    {
        return $rootNamespace . '\\Abstractions\\'.Str::plural($this->type);
    }
}