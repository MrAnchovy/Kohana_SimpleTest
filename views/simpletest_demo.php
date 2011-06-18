<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * @package    Simpletest
 * @category   Kohana interface
 * @author     Mr Anchovy
 * @copyright  (c) 2011 Mr Anchovy
 * @license    http://opensource.org/licenses/ISC
 */
?><!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml">
<head>
<title>Simpletest Module Demonstration</title>
</head>
<body>
<h1>SimpleTest Module for Kohana</h1>

<p>To view the demonstration, go to
<a href="<?php echo Kohana::$base_url ?>simpletest/run/simpletest"><?php echo Kohana::$base_url ?>simpletest/run/simpletest</a>.
</p>

<p>Create your own tests in a directory 'simpletests' in your application directory.
Name the files test_tricky_class.php or whatever (they must start with test_).
You can run all tests with this link:
<a href="<?php echo Kohana::$base_url ?>simpletest/run"><?php echo Kohana::$base_url ?>simpletest/run</a>.
Or to run just the tests in files matching test_tricky*.php, go to
<a href="<?php echo Kohana::$base_url ?>simpletest/run/tricky"><?php echo Kohana::$base_url ?>simpletest/run/tricky</a>.
</p>

<p>That's it! No PEAR, no command line, just Simple Unit Testing. Oh and there's
an excellent remote web test suite and a few other goodies thrown in...</p>

<p>For more information see the
<a href="http://www.simpletest.org">SimpleTest web site</a>,
and the home page for this module at
<a href="https://www.github.com/MrAnchovy/Kohana_SimpleTest">GitHub</a>.
</p>

</body>
</html>
