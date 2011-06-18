<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * @package    Simpletest
 * @category   Demo
 * @author     Mr Anchovy
 * @copyright  (c) 2011 Mr Anchovy
 * @license    http://opensource.org/licenses/ISC
 */

class Test_Simpletest_Demo extends UnitTestCase {

// assertTrue($x)	Fail unless $x evaluates true
function test_assert_true() {
  $x = TRUE;
  $this->assertTrue($x, 'Should be TRUE|%s');
}

// assertFalse($x)	Fail unless $x evaluates false
function test_assert_false() {
  $x = FALSE;
  $this->assertFalse($x, 'Should be FALSE|%s');
}

// assertNull($x)	Fail unless $x is not set
function test_assert_null() {
  $x = NULL;
  $this->assertNull($x, 'Should be NULL|%s');
}

// assertNotNull($x)	Fail unless $x is set to something
function test_assert_not_null() {
  $x = 'A string';
  $this->assertNotNull($x, 'Should not be NULL|%s');
}

// assertIsA($x, $t)	Fail unless $x is the class or type $t
function test_assert_is_a() {
  $x = new View;
  $this->assertIsA($x, 'View', 'Should be a View object|%s');
}

// assertNotA($x, $t)	Fail unless $x is not the class or type $t
function test_assert_not_a() {
  $x = new stdClass;
  $this->assertNotA($x, 'View', 'Should not be a View object|%s');
}

// assertEqual($x, $y)	Fail unless $x == $y is true
function test_assert_equal() {
  $x = 'Hello World';
  $this->assertEqual($x, 'Hello World', 'Should equal \'Hello World\' - see warning below|%s');
}

// assertNotEqual($x, $y)	Fail unless $x == $y is false
function test_assert_not_equal() {
  $x = 'Hello World';
  $this->assertNotEqual($x, 'Hello', 'Should not equal \'Hello World\' - see warning below|%s');
}

// assertWithinMargin($x, $y, $margin)	Fail unless $x and $y are separated less than $margin
function test_assert_within_margin() {
  $x = 90;
  $this->assertWithinMargin(100, $x, 10, 'Should be within 10 of 100|%s');
}

// assertOutsideMargin($x, $y, $margin)	Fail unless $x and $y are sufficiently different
function test_assert_outside_margin() {
  $x = 89;
  $this->assertOutsideMargin(100, $x, 10, 'Should not be within 10 of 100|%s');
}

// assertIdentical($x, $y)	Fail unless $x === $y for variables, $x == $y for objects of the same type
function test_assert_identical() {
  $x = 'Hello World';
  $this->assertIdentical($x, 'Hello World', 'Should be identical to the string \'Hello World\'|%s');
}

// assertNotIdentical($x, $y)	Fail unless $x === $y is false, or two objects are unequal or different types
function test_assert_not_identical() {
  $x = 'Hello World';
  $this->assertNotIdentical($x, 0, 'Should not be identical to 0|%s');
}

// assertReference($x, $y)	Fail unless $x and $y are the same variable
function test_assert_reference() {
  $x = 'Hello World';
  $y =& $x;
  $this->assertReference($x, $y, 'Should refer to the same variable|%s');
}

// assertCopy($x, $y)	Fail unless $x and $y are the different in any way
function test_assert_copy() {
  $x = new stdClass();
  $y = new stdClass();
  $this->assertCopy($x, $y, 'Should only be used with objects, arguments should be copies or clones, not the same object|%s');
}

// assertSame($x, $y)	Fail unless $x and $y are the same objects
function test_assert_same() {
  $x = new stdClass();
  $y = &$x;
  $this->assertSame($x, $y, 'Should only be used with objects, arguments should reference the same object|%s');
}

// assertClone($x, $y)	Fail unless $x and $y are identical, but separate objects
function test_assert_clone() {
  $x = new stdClass();
  $y = new stdClass();
  $this->assertClone($x, $y, 'Should only be used with objects, arguments should be copies or clones, not the same object|%s');
}

// assertPattern($p, $x)	Fail unless the regex $p matches $x
// assertNoPattern($p, $x)	Fail if the regex $p matches $x

// expectError($e)	Triggers a fail if this error does not happen before the end of the test
function test_expect_error() {
  $this->expectError(TRUE, 'Should cause an error|%s');
  $x = 1/0;
}

// expectException($e)	Triggers a fail if this exception is not thrown before the end of the test
function test_expect_exception() {
  $this->expectException('Kohana_Exception', 'Should throw a Kohana_Exception|%s');
  throw new Kohana_Exception('Told you so');
}

}

class Test_Simpletest_Show_Dangers extends UnitTestCase {

function test_assert_equal_loose() {
  $this->assertEqual('123', 123, 'Strings are converted when compared to integers so assertEqual(\'123\', 123) passes|%s');
}

function test_assert_equal_loose_unexpected() {
  $this->assertEqual('Hello World', 0, 'Strings that do not represent a number are converted to 0 so assertEqual(\'Hello World\', 0) passes|%s');
}


}
