<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * @author     Mr Anchovy
 * @copyright  (c) 2011 Mr Anchovy
 * @license    http://opensource.org/licenses/ISC
 */
Route::set('simpletest', 'simpletest(/<action>(/<arg>))', array('arg'=>'(.*)'))
	->defaults(array(
		'controller' => 'simpletest',
		'action'     => 'index',
	));
