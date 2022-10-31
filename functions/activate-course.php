<?php
require_once('../config/connect.php');
require_once('functions.php');


if (isset($_GET['result_id']) && isset($_GET['course_id']) && isset($_GET['semester']) && isset($_GET['course_credits']) && isset($_GET['set']) && isset($_GET['practical_lecturer_name'])) {
    activateCourse($_GET['course_id'], $_GET['result_id'], calculateStudentLevel($_GET['set']),  $_GET['set'], $_GET['course_credits']);
    gotoPage('../active-courses');
} elseif (isset($_SESSION['active_course_id'])) {
    gotoPage('../active-courses');
} else {
    echo 'Error, Course Session not created!';
}
