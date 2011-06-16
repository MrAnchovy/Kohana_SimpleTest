<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * @package    Simpletest
 * @category   Kohana interface
 * @author     Mr Anchovy
 * @copyright  (c) 2011 Mr Anchovy
 * @license    http://opensource.org/licenses/ISC
 */
class Controller_Simpletest extends Controller {

// BEFORE ------------------------------------------------------------------ */

public function before() {
  parent::before();
  define('SIMPLETEST_PATH', realpath(dirname(__FILE__).'/../../simpletest').'/');
  define('SIMPLETEST_TESTS_PATH', Kohana::config('simpletest.tests_path'));
}

// ACTIONS ----------------------------------------------------------------- */

public function action_doc() {

  $file = $this->request->param('arg');
  if ( empty($file) ) {
    $file = 'index.html';
  }
  $file = SIMPLETEST_PATH.'docs/en/'.$file;

  if ( file_exists($file) ) {
    echo file_get_contents($file);
  } else {
    $file = SIMPLETEST_PATH.'docs/en/index.html';
    echo file_get_contents($file);
    echo $file;
  }

}

public function action_index() {
}

public function action_run() {

  if ( !file_exists(SIMPLETEST_TESTS_PATH) ) {
    echo 'The test directory does not exist - you need to create '.SIMPLETEST_TESTS_PATH.' and put a test file in it.';
    return;
  }
  require_once(SIMPLETEST_PATH.'autorun.php');
// in simpletest/web_tester.php - avoids creation of null test case
// abstract class WebTestCase extends SimpleTestCase {
  require_once(SIMPLETEST_PATH.'web_tester.php');

  if ( $reporter = Kohana::config('simpletest.reporter') ) {
    SimpleTest::prefer(new $reporter);
  }

  $pattern = $this->request->param('arg');
  $tests = new TestSuite('Tests matching '.htmlspecialchars($pattern));
  // choose \test_ for Windows otherwise /test_
  $pattern = DIRECTORY_SEPARATOR=='\\'
    ? '#\\\\test_'.$pattern.'.*\.php#'
    : '#\/test_'.$pattern.'.*\.php#';
  $tests->collect(SIMPLETEST_TESTS_PATH, new SimplePatternCollector($pattern));
}

}
