<?php defined('SYSPATH') or die('No direct access allowed.');
/**
 * @package    Simpletest
 * @category   Kohana interface
 * @author     Mr Anchovy
 * @copyright  (c) 2011 Mr Anchovy
 * @license    http://opensource.org/licenses/ISC
 */
class SimpleTest_Reporter_Html extends HtmlReporter {
    
/**
 * void paintHeader(string $test_name)
 *
 * is called once at the very start of the test when the first start event arrives. The first start event is usually delivered by the top level group test and so this is where $test_name comes from. It paints the page title, CSS, body tag, etc. It returns nothing (void).
*/
function paintHeader($test_name) {
  parent::paintHeader($test_name);
?>
<table style="border-collapse: collapse;">
<tr class="head">
  <th>Test</td>
  <th>Message</td>
  <th>&nbsp;</td>
  <th>Details</td>
</tr>
<?php
}


function paintCaseStart($test_name) {
  SimpleReporter::paintCaseStart($test_name);
?>
<tr class="start case"><td colspan="4"><?php echo "Class: $test_name"; ?></td></tr>
<?php
}


/**
 * Paints a PHP error.
 *
 * @param string $message        Message is ignored.
 * @access public
 */
function paintError($message) {
  SimpleReporter::paintError($message);
  $this->paint_bad($message, 'error');
}

/**
 * Paints a PHP exception.
 *
 * @param   Exception  $exception        Exception to display.
 * @access  public
 */
function paintException($exception) {
  SimpleReporter::paintException($exception);
  $message = 'Unexpected exception of type [' . get_class($exception) .
    '] with message ['. $exception->getMessage() .
    '] at ['. $exception->getFile() .
    ' line ' . $exception->getLine() . ']';
  $this->paint_bad($message, 'exception');
}

function paintFail($message) {
  SimpleReporter::paintFail(NULL);
  $this->paint_bad($message, 'Fail');
}

function paintPass($message) {
  SimpleReporter::paintPass(NULL);
  $this->paint_good($message, 'Pass');
}

/**
 * Prints the message for skipping tests.
 * @param string $message    Text of skip condition.
 * @access public
 */
function paintSkip($message) {
  SimpleReporter::paintSkip($message);
  $this->paint_good($message, 'skip');
}


protected function getCss() {
  return file_get_contents(realpath(SIMPLETEST_PATH.'../pub/css').'/simpletest_reporter_html.css');
}

protected function paint_bad($message, $type) {
  $breadcrumb = $this->getTestList();
  $test = array_pop($breadcrumb);
  $msg = $this->split($message);
?>
<tr class="bad <?php echo strtolower($type); ?>">
  <td class="test"><?php echo $test; ?></td>
  <td class="msg"><?php echo $msg[0]; ?></td>
  <td class="porf"><?php echo $type ?></td>
  <td class="details">
    <p class="assert"><?php echo $msg[1]; ?></p>
    <p class="location"><?php echo $msg[2]; ?> line <?php echo $msg[3]; ?>
  </td>
</tr>
<?php
}

/*
void paintFooter(string $test_name)
Called at the very end of the test to close any tags opened by the page header. By default it also displays the red/green bar and the final count of results. Actually the end of the test happens when a test end event comes in with the same name as the one that started it all at the same level. The tests nest you see. Closing the last test finishes the display.
*/
function paintFooter($test_name) {
  echo "</table>\n";
  parent::paintFooter($test_name);
}

// HELPERS ----------------------------------------------------------------- */

protected function paint_good($message, $type) {
  $breadcrumb = $this->getTestList();
  $test = array_pop($breadcrumb);
  $msg = $this->split($message);
?>
<tr class="good <?php echo strtolower($type); ?>">
  <td class="test"><?php echo $test; ?></td>
  <td class="msg"><?php echo $msg[0]; ?></td>
  <td class="porf"><?php echo $type; ?></td>
  <td class="details"><p class="assert"><?php echo $msg[1]; ?></p></td>
</tr>
<?php
}

protected function split($message) {
  // get filename
  // $pattern = '@^((.*)\||)((.*) at \[.*\/(.*) line ([0-9]+)\]|)$@si';
  // get file path
  $pattern = '@^((.*)\||)((.*) (in|at) \[(.*) line \[?([0-9]+)\]?\]|)$@si';
  $matches = array();
  $count = preg_match($pattern, $message, $matches);
  if ( $count==0 ) {
    return array(
      'Unknown', // message
      htmlspecialchars($message), // assert
      NULL, // 
      NULL,
    );
  } else {
    return array(
      htmlspecialchars($matches[2]), // message
      htmlspecialchars($matches[4]), // test
      $matches[6], // file
      $matches[7], // line
  //  htmlspecialchars($matches[2]),
    );
  }
}

}
