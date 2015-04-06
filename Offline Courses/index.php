<?php 
require_once('../../config.php');
require_once($CFG->libdir . '/adminlib.php');

$courseid = required_param('course', PARAM_INT); //The course ID
$course = $DB->get_record('course', array('id' => $courseid), '*', MUST_EXIST); //Grab the course from the database using the course ID

//Require Login and admin 
require_login();
isadmin();

$PAGE->set_context(context_system::instance());
$PAGE->set_pagelayout('standard');
$PAGE->set_title('Set Course Price');
$PAGE->set_heading('Set Course Price');
$PAGE->set_url($CFG->wwwroot.'/course/prices/index.php');
echo $OUTPUT->header();
?>

<form method="post" action="post.php">
        <h2>Online or Offline Course?</h2><br>
       
        <label for="Online">Online Course </label>
        <input type="checkbox" name="online" type="" method='post' />
	
        <br>
                
	<label for="Offline">Offline Course </label> 
        <input type="checkbox" name="offline" type="" method='post' />
    
	
        <br>
        <input type="submit" value="">
</form>
<?php

// Trigger a content view event.
$event = \report_stats\event\report_viewed::create(array('context' => $context, 'relateduserid' => $userid,
        'other' => array('report' => $report, 'time' => $time, 'mode' => $mode)));
$event->trigger();

// Trigger a content view event.
$event = \report_stats\event\report_viewed::create(array('context' => $context, 'relateduserid' => $userid,
        'other' => array('report' => $report, 'time' => $time, 'mode' => $mode)));
$event->trigger();

function get_form_information() {
	$startMonth = $_POST['startMonth'];
	$startYear = $_POST['startYear'];
	$endMonth = $_POST['endMonth'];
	$endYear = $_POST['endYear'];
        
        return array($startMonth, $startYear, $endMonth, $endYear);
}

function get_data($startYear, $startMonth, $endYear, $endMonth) {
    $where_query = 'date between \''.$startYear.'-'.$startMonth.'-00\' AND \''.$endYear.'-'.$endMonth.'-00\''; //Moodle auto-inserts the "WHERE" keyword
    $list = $DB -> get_records_select(TABLE, $where_query);    
    
    return $list;
} //End get_data

echo $OUTPUT->footer();
?>