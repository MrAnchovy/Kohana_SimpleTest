<?php defined('SYSPATH') or die('No direct access allowed.');

return array(
  'module_version' => array( 'simpletest' => '1.01.001' ),
  'reporter'    => 'SimpleTest_Reporter_Html',
  'tests_path'  => array(
    'app' => APPPATH.'simpletests',
    'demo' => realpath(dirname(__FILE__).'/..').DIRECTORY_SEPARATOR.'simpletests',
  ),
);
