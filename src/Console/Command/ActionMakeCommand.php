<?php


namespace SweetwoodEU\Laravel\CodeAbstraction\Console\Command;


class ActionMakeCommand extends GeneratorCommand
{
    protected $name = "make:action";
    protected $description = "Create a new action class";
    protected $type = "Action";
}