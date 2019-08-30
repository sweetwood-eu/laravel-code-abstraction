<?php


namespace SweetwoodEU\Laravel\CodeAbstraction\Tests\Unit\Console\Command;


use SweetwoodEU\Laravel\CodeAbstraction\Providers\ServiceProvider;
use SweetwoodEU\Laravel\CodeAbstraction\Tests\TestCase;

class ActionMakeTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class
        ];
    }


    /** @test */
    public function it_creates_a_action_file()
    {
        $this->artisan('make:a:action Test')
            ->assertExitCode(0);


    }

}