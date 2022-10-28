<?php
require_once('../config/connect.php');
require_once('functions.php');
//die;

if (!isset($_POST)) {
    print json_encode([['error' => 'Unknown Error Occured']]);
} else {
    extract($_POST);
    switch ($_POST) {
        case (!empty($session_select) &&
            !empty($course_credits) &&
            !empty($semester_select)):

            if ($_SESSION['course_edit']) {
                #region Edit Session
                if (!empty($lecturer_search_input)) {
                    $lecturerId =  getLecturerId($lecturer_search_input);
                    $has_practicals = 1;
                } else {
                    $lecturerId = "null";
                    $has_practicals = 0;
                }

                if ($lecturerId) {
                    if (updateCourseSession($_SESSION['course_id'], $_SESSION['lecturer_id'], $_SESSION['course_id'], $course_credits, $session_select, $semester_select, $has_practicals, $lecturerId)) {
                        print json_encode([['success' => 'Course Session Updated!']]);
                    } else {
                        print json_encode([['error' => 'Database Error! Session not updated.']]);
                    }
                } else {
                    print json_encode([['error' => 'Practical Lecturer not found']]);
                }
                $_SESSION['course_edit'] = false;
                #endregion
            } else {
                #region Create New Session
                if (!empty($lecturer_search_input)) {
                    $lecturerId =  getLecturerId($lecturer_search_input);
                    $has_practicals = 1;
                } else {
                    $lecturerId = "null";
                    $has_practicals = 0;
                }

                if ($lecturerId) {
                    if (!checkForDuplicateWithTwoColumns('results', 'set_year', $session_select, 'course_id', $_SESSION['course_id'])) {
                        if (createNewCourseSession($_SESSION['lecturer_id'], $_SESSION['course_id'], $course_credits, $session_select, $semester_select, $has_practicals, $lecturerId)) {
                            print json_encode([['success' => 'Session Created!']]);
                        } else {
                            print json_encode([['error' => 'Database Error! Session not created.']]);
                        }
                    } else {
                        print json_encode([['error' => 'Course session for ' . $session_select . ' set already exists. Make edits instead.']]);
                    }
                } else {
                    print json_encode([['error' => 'Practical Lecturer not found']]);
                }
                #endregion
            }
            break;
        default:
            print json_encode([['error' => 'Data Missing']]);
            break;
    }
}
//['first_name', 'last_name','student_gender', 'student_email', 'student_phone', 'student_reg','student_department', 'password1', 'password2', 'agree']