<?php
require_once('config/connect.php');
require_once('functions/functions.php');

echo '<pre>';

// print_r(getCoursesHandledByLecturer($_SESSION['lecturer_id']));

//print_r($_POST);
//echo(getLecturerId("Urbain Speedy"));

// if (checkForDuplicateWithTwoColumns('results', 'set_year', '2020/2021', 'course_id', 163)) {
//     echo 'There is a duplicate';
// }

// if(
// updateCourseSession(2059,1,1,2,'20xx/xxxx', 2, 1, 2)){
//     echo 'Successfully Updated';
// }

//loadSessions();

//print_r (loadStudentsForParticularCourseSession('2017/2018'));

// $results = getResults(2071);

// $incourseTotal = 0;
// $incourseAbsoluteTotal = 0;

// $examTotal = 0;
// $examAbsoluteTotal = 0;

// foreach ($results as $result) {
//     $resultIncourse = $result['incourse'];
//     $resultExam = $result['exam'];

//     foreach ($resultIncourse as $incourse) {
//         $incourseAbsoluteTotal += $incourse['total'];
//         $incourseTotal += $incourse['score'];
//     }

//     foreach ($resultExam as $exam) {
//         $examAbsoluteTotal += $exam['total'];
//         $examTotal += $exam['score'];
//     }
// }

// $incourse = 30 * ((($incourseTotal / $incourseAbsoluteTotal) * 100) / 100);
// echo ceil($incourse);

// echo '<br>';

// $exam = 70 * ((($incourseTotal / $incourseAbsoluteTotal) * 100) / 100);
// echo ceil($exam);

// return (array("incourse" => $incourse, "exam" => $exam));

// $compiledResult = returnCompiledResult(1, '2017030180311');
// print_r($compiledResult);

$results = getResults(1);
sort($results[0]['incourse']);
print_r($results);

