<?php
require_once('../config/connect.php');
require_once('functions.php');


if (isset($_GET['course_id'])) {
    $courseInfo = getCourseInfo($_GET['course_id']);
    $_SESSION['active_course_id'] = $_GET['course_id'];
    $_SESSION['active_course_name'] = $courseInfo['course_name'];
    $_SESSION['active_course_code'] = $courseInfo['course_code'];
    $_SESSION['active_course_department_id'] = $courseInfo['department_id'];
    gotoPage('../all-courses');
}
