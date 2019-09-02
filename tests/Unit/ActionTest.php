<?php


namespace SweetwoodEU\Laravel\CodeAbstraction\Tests\Unit;


use SweetwoodEU\Laravel\CodeAbstraction\Abstractions\Action;
use SweetwoodEU\Laravel\CodeAbstraction\Exceptions\PayloadValidationException;
use SweetwoodEU\Laravel\CodeAbstraction\Tests\TestCase;

class ActionTest extends TestCase
{

    /** @test */
    public function an_action_can_be_invoked()
    {
        $actionClass = new class extends Action {
            public function action()
            {
                return $this->payload();
            }
        };

        $this->assertTrue($actionClass('test'));
        $this->assertEquals('test', $actionClass->result());
    }

    /** @test */
    public function an_action_can_throw_an_exception_and_it_will_result_in_false()
    {
        $actionClass = new class extends Action {
            public function action()
            {
                throw new \Exception('Test');
            }
        };

        $this->assertFalse($actionClass('test'));
        $this->assertInstanceOf(\Exception::class, $actionClass->exception());

        $this->expectExceptionMessage('Test');
        $actionClass->resultOrThrow();
    }

    /** @test */
    public function an_action_can_be_validated()
    {
        $actionClass = new class extends Action {
            public function action()
            {
                throw new \Exception('Test');
            }

            protected function validatePayload($payload): bool
            {
                return is_int($payload);
            }
        };

        $this->expectException(PayloadValidationException::class);

        $this->assertFalse($actionClass('This is not an integer!'));

        $actionClass->resultOrThrow();
    }


}