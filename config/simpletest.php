<?php defined('SYSPATH') or die('No direct access allowed.');

return array(
  'reporter'    => 'SimpleTest_Reporter_Html',
  'tests_path'  => array(
    'app' => APPPATH.'simpletests',
    'demo' => realpath(dirname(__FILE__).'/..').'/simpletests',
  ),
);
