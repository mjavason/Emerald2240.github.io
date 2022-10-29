<?php
require_once('../config/connect.php');
require_once('functions.php');


if (isset($_GET['course_id'])) {
    extract($_GET);
    activateCourse($course_id, $table_id, $level, $set_year);

    gotoPage('../active-courses');
}
