<?php
require_once('../config/connect.php');
require_once('functions.php');
//die;

if (!isset($_POST)) {
    print json_encode([['error' => 'Unknown Error Occured']]);
} else {
    extract($_POST);
    switch ($_POST) {
        case (!empty($grade_title) &&
        !empty($grade_total) &&
        !empty($student_reg_number) &&
        !empty($student_score)):
            // if (!isset($_SESSION['course_edit'])) {
            //     $_SESSION['course_edit'] = false;
            // }

            if ($grade_title == "Exam") {
                setExam($student_reg_number, $grade_title, $grade_total, $student_score, $_SESSION['active_course_id'], $_SESSION['active_course_credits'], $_SESSION['active_course_set_year']);
            } else {
                addIncourse($student_reg_number, $grade_title, $grade_total, $student_score, $_SESSION['active_course_id'], $_SESSION['active_course_credits'], $_SESSION['active_course_set_year']);
            }

            if (updateCourseSessionResult($_SESSION['active_course_table_id'], $_SESSION['active_course_grades'])) {
                if ($grade_title == "Exam") {
                    print json_encode([['success' => 'Grade Added For ' . $student_reg_number], ['destination' => 'grade-exam']]);
                } else {
                    print json_encode([['success' => 'Grade Added For ' . $student_reg_number], ['destination' => 'grade']]);
                }
            } else {
                print json_encode([['error' => 'Database Error! Grade Not Saved.']]);
            }
            break;
        default:
            print json_encode([['error' => 'Some input fields are missing or invalid.']]);
            break;
    }
}
//['first_name', 'last_name','student_gender', 'student_email', 'student_phone', 'student_reg','student_department', 'password1', 'password2', 'agree']