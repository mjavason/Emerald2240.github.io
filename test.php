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

//$results = getResults(1);
// sort($results[0]['incourse']);
// echo(getStudentName('2017030180311'));

// print_r(json_encode($_SESSION['active_course_grades']));

// print_r(addIncourse('2017030180311', 'Quiz 15', '10', '10'));
//echo (json_encode(addIncourse('2517819440', 'Practicals', '100', '100')));

//echo(json_encode(setExam('2017030180311', 'Exam', '70', '70')));

// unset($_SESSION['active_course_grades'][0]['incourse']);
// echo('Deleted<br>');

print_r($_SESSION['active_course_grades']);

// print_r(json_encode($_SESSION));
















// $testResult = '[ {
//     "reg_num": "2506239642",
//     "incourse": [
//         {
//             "title": "Quiz",
//             "total": 100,
//             "score": 100
//         },
//         {
//             "title": "Project",
//             "total": 100,
//             "score": 25
//         }
//     ],
//     "exam": [
//         {
//             "title": "Exam",
//             "total": 70,
//             "score": 25
//         }
//     ]
// }]';

// $testResult = json_decode($testResult, true);

// $gradeTitle = 'Exam';
// $gradeTotal = 70;
// $studentScore = 35;

// $incourseArrayItem = array("title" => $gradeTitle, "total" => (int) $gradeTotal, "score" => (int) $studentScore);

// unset($testResult[0]['exam']);
// //array_push($testResult[0]['exam'], $incourseArrayItem);
// $testResult[0]['exam'][0] = $incourseArrayItem;

// print_r(json_encode($testResult));