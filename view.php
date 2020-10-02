<?php
// This file is part of Moodle - http://moodle.org/
//
// Moodle is free software: you can redistribute it and/or modify
// it under the terms of the GNU General Public License as published by
// the Free Software Foundation, either version 3 of the License, or
// (at your option) any later version.
//
// Moodle is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// You should have received a copy of the GNU General Public License
// along with Moodle.  If not, see <http://www.gnu.org/licenses/>.

/**
 * Library of interface functions and constants.
 *
 * @package     mod_courseuserspage
 * @copyright   2020 Your Name <you@example.com>
 * @license     http://www.gnu.org/copyleft/gpl.html GNU GPL v3 or later
 */

require(__DIR__.'/../../config.php');
require_once($CFG->libdir.'/enrollib.php');


$id        = optional_param('id', 0, PARAM_INT); // Course Module ID

if ($id) 
	{
		$cm = get_coursemodule_from_id('courseuserspage', $id, 0, false, MUST_EXIST);
		// get course by id from course table
		$course = $DB->get_record('course', array('id'=>$cm->course), '*', MUST_EXIST);
	}
require_course_login($course, true, $cm);
// var_dump($course);
// die();

$coursecontext = context_course::instance($course->id);

$PAGE->set_url('/mod/courseuserspage/view.php', array('id' => $course->id));// set this pages url
$PAGE->set_title('View All users in this course');
$PAGE->set_context(\context_system::instance());

// select all rows from enrolled_users tbale
$enrolledusers = get_enrolled_users($coursecontext, '', 0, 'u.*', null, 0, 0, true);

//foreach enrolledusers
//build array with id, fname, lname, userpic
foreach($enrolledusers as $enrolleduser) {
	$x = array();
	$x['id'] = $enrolleduser->id;
	$x['name'] = $enrolleduser->firstname;
	$x['lastname'] = $enrolleduser->lastname;
    $x['pic'] = $OUTPUT->user_picture($enrolleduser, array('size' => 100, 'class' => 'user_image'));

    //pass array x to data object
    $data->enrolledusers[] = $x;
}

//sort enrolled users 
sort($enrolledusers);

echo $OUTPUT->header(); // from output_renderers.php 
//render from templates/view.mustache
echo $OUTPUT->render_from_template('mod_courseuserspage/view', $data);

echo $OUTPUT->footer(); // from output_renderers.php 