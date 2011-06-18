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
  if ( strpos(Kohana::VERSION, '3.1')===FALSE ) {
    $this->request->response = View::factory('simpletest_demo');
  } else {
    $this->response->body(View::factory('simpletest_demo'));
  }
}

protected function get_test_paths() {
  return Kohana::config('simpletest.tests_path');
}


public function action_run() {

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
  foreach ( $this->get_test_paths() as $path ) {
    if ( is_dir($path) ) {
      $tests->collect($path, new SimplePatternCollector($pattern));
    }
  }
}

}
