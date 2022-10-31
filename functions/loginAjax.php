<?php
require_once('../config/connect.php');
require_once('functions.php');
//die;

extract($_POST);
switch ($_POST) {
    case (isset($_POST['login_email']) && isset($_POST['login_password'])):
        # code...

        if (validateEmail($login_email) && !validateLecturerEmail($student_email) && !validateSuperAdminEmail($student_email)) {
            print json_encode(confirmUserEmailAndPassword($login_email, $login_password, isset($login_remember_me)));
        } else {
            print json_encode([['error' => 'Invalid Email']]);
        }
        break;
        //Login functionality

    case (isset($_POST['student_email']) && isset($_POST['first_name']) && isset($_POST['last_name']) && isset($_POST['student_gender']) && isset($_POST['student_phone']) && isset($_POST['student_reg']) && isset($_POST['student_department']) && isset($_POST['agree']) && isset($_POST['password1']) && isset($_POST['password2'])):
        if ($password1 === $password2) {
            if (!validateEmail($student_email) && !validateStudentRegNumber($student_reg) && !validateLecturerEmail($student_email) && !validateSuperAdminEmail($student_email)) {
                $departmentId = getDepartmentId($student_department);
                if ($departmentId) {
                    if (createNewStudent($first_name, $last_name, $student_gender, $student_email, $student_phone, $student_reg, $departmentId, $password1)) {
                        $arrayAssoc = ([['Success' => 'User Successfully registered']]);
                        print json_encode($arrayAssoc);
                    } else {
                        $arrayAssoc = ([['error' => 'Unknown error occured']]);
                        print json_encode($arrayAssoc);
                    }
                } else {
                    $arrayAssoc = ([['error' => 'School Department not found']]);
                    print json_encode($arrayAssoc);
                }
            } else {
                $arrayAssoc = ([['error' => 'Unable to register. User already exists']]);
                print json_encode($arrayAssoc);
            }
        } else {
            $arrayAssoc = ([['error' => 'Passwords do not match']]);
            print json_encode($arrayAssoc);
        }
        break;
        //Create new user functionality
}
//['first_name', 'last_name','student_gender', 'student_email', 'student_phone', 'student_reg','student_department', 'password1', 'password2', 'agree']