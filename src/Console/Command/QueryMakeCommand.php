<?php


namespace SweetwoodEU\Laravel\CodeAbstraction\Console\Command;


class QueryMakeCommand extends GeneratorCommand
{
    protected $name = "make:query";
    protected $description = "Create a new query class";
    protected $type = "Query";
}