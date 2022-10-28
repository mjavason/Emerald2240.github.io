<?php
require_once('config/connect.php');
require_once('functions/functions.php');

echo '<pre>';

// print_r(getCoursesHandledByLecturer($_SESSION['lecturer_id']));

//print_r($_POST);
//getLecturerId("Urbain Speedy");

if(checkForDuplicateWithTwoColumns('results', 'set_year', '2020/2021', 'course_id', 163)){
    echo 'There is a duplicate';
}
