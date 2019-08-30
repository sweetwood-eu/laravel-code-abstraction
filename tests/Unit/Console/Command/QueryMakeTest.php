<?php


namespace SweetwoodEU\Laravel\CodeAbstraction\Tests\Unit\Console\Command;


use SweetwoodEU\Laravel\CodeAbstraction\Providers\ServiceProvider;
use SweetwoodEU\Laravel\CodeAbstraction\Tests\TestCase;

class QueryMakeTest extends TestCase
{
    protected function getPackageProviders($app)
    {
        return [
            ServiceProvider::class
        ];
    }

    /** @test */
    public function it_creates_a_query_file()
    {
        $this->artisan('make:query Test')
            ->assertExitCode(0);
    }
}