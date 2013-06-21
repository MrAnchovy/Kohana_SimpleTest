<?php

class Simpletest_ReporterDecorator_Verbose extends SimpleReporterDecorator {


function __construct($reporter) {
  parent::__construct($reporter);
  $this->reporter = $reporter;
}

    /**
     *    Paints the test failure as a stack trace.
     *    @param string $message    Failure message displayed in
     *                              the context of the other tests.
     *    @access public
     */
    function paintPass($message) {
        parent::paintPass($message);
        echo substr($message, 0, strpos($message, '|')) . "\n";
    }
}
