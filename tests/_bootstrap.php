<?php
use Codeception\Test\Descriptor;

include_once __DIR__.'/_support/Helper/Failure.php';

// Note: this was drafted using Codeception 2.0.  Some of the namespaces
// maybe different if you're using a more-recent version of Codeception.
class MyCustomEventHandler extends \Codeception\Platform\Extension
{
    /**
     * @var \Exception[]
     */
    protected $testFailures = [];

    /**
     * Maps Codeception events to method names in this class.
     *
     * Defining an event/method pair in this array essentially subscribes
     * the method as a listener for its corresponding event.
     *
     * @var array
     */
    public static $events = [
        \Codeception\Events::TEST_FAIL       => 'singleTestJustFailed',
        \Codeception\Events::TEST_FAIL_PRINT => 'allTestFailuresAreBeingDisplayed',
    ];

    /**
     * This method will automatically be invoked by Codeception when a test fails.
     *
     * @param \Codeception\Event\FailEvent $event
     */
    public function singleTestJustFailed(\Codeception\Event\FailEvent $event)
    {
        // Here we build a list of all the failures. They'll be consumed further downstream.
        $this->testFailures[] = $event->getFail();
    }

    /**
     * This method will automatically be invoked by Codeception when it displays
     * a summary of all the test failures at the end of the test suite.
     */
    public function allTestFailuresAreBeingDisplayed()
    {
        // Build the email.
        $emailBody = '';
        foreach ($this->testFailures as $failure) {
            // Methods in scope include: $failure->getMessage(), $failure->getFile(), etc.
            $emailBody .= $failure->getMessage() . "\r\n";
        }

        // Now send the email!
    }
}