<?php
require_once('config/connect.php');
require_once('functions/functions.php');

echo '<pre>';
print_r(getCoursesHandledByLecturer(2));
