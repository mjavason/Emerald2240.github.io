<?php
require_once('../config/connect.php');
require_once('functions.php');
//die;

if (isset($_GET['result_id'])) {
    if (deactivateCourseSession($_GET['result_id'])) {
        if ($_SESSION['active_course_table_id'] == $_GET['result_id']);
        deactivatecourse($_SESSION['active_course_table_id']);
        gotoPage('../active-courses');
    }
} else {
    gotoPage('../active-courses');
}
