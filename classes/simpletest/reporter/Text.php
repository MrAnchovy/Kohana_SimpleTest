<?php

class Simpletest_Reporter_Text extends TextReporter {

    /**
     *    Does nothing yet. The first output will
     *    be sent on the first test start.
     */
    function __construct() {
        parent::__construct();
    }


    /**
     *    Paints the test failure as a stack trace.
     *    @param string $message    Pass message
     *    @access public
     */
    function paintPass($message) {
        parent::paintPass($message);
        echo '.';
    }
}
