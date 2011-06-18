<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * @package    Simpletest
 * @category   Kohana interface
 * @author     Mr Anchovy
 * @copyright  (c) 2011 Mr Anchovy
 * @license    http://opensource.org/licenses/ISC
 */
//Route::set('simpletest', 'simpletest(/<action>(/<arg>))', array('arg'=>'(.*)'))
Route::set('simpletest', 'simpletest(/<action>(/<arg>))')
	->defaults(array(
		'controller' => 'simpletest',
		'action'     => 'index',
	));
