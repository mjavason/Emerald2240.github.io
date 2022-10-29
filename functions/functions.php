<?php
session_start();
$db_handle = new DBController();

$first_name = 'Tester';
$last_name = 'Zero';
$id = 1;
$postemail = 'testerzero@mail.com';
$phone = '08148863871';


$_SESSION['user_name'] = ucwords(strtolower($first_name)) . " " . ucwords(strtolower($last_name));
$_SESSION['first_name'] = $first_name;
$_SESSION['last_name'] = $last_name;
$_SESSION['full_name'] = $first_name . ' ' . $last_name;
$_SESSION['lecturer_id'] = $id;
$_SESSION['lecturer_email'] = $postemail;
$_SESSION['phone'] = $phone;

$_SESSION['log'] = true;


/**
 * Removes unwanted and harmful characters
 * 
 * Takes in a string cleanses and formats it, then returns a clean copy.
 * 
 * @param string $data
 * Any data or variable that may contain characters that needs cleansing.
 * @param string $case
 * [optional]
 * 
 * If set to 'lower' it automatically formats the results to lowercase, if set to 'none' it is left as it is, if set to 'clean' it formats the results to uppercase.
 * @return string
 * Returns cleansed string.
 */
function sanitize($data, $case = null)
{
  $result = htmlentities($data, ENT_QUOTES);
  if ($case == 'lower') {
    $result = strtoupper($result);
  } elseif ($case == 'none') {
    //leave it as it is
  } elseif ($case == 'clean') {
    $result = ucwords(strtolower($result));
  } else {
    $result = strtoupper($result);
  }
  return $result;
}

function gotoPage($location)
{
  header('location:' . $location);
  exit();
}

function showSweetAlert($type, $id = null)
{
  switch ($type) {
    case 'success':
      echo '<script>swal({
                //title: "New Course",
                title: "Successful",
                icon: "success",
                button: "Got It!",
              });</script>';
      break;

    case 'course_save_success':
      echo '<script>
            swal({
                //title: "New Course",
                title: "Successful",
                icon: "success",
                button: "Got It!",
            });
        </script>';
      break;

    case 'client_paid_admin_success':
      echo '<script>swal({
                        //title: "Edit Course",
                        title: "Client Payment Confirmed",
                        icon: "success",
                        button: "Got It!",
                      });</script>';
      break;

    case 'course_delete_success':
      echo '<script>swal({
                        //title: "Delete Course",
                        title: "Course Deleted Succesfully",
                        icon: "success",
                        button: "Got It!",
                      });</script>';
      break;

    case 'failure':
      echo '<script>swal({
                title: "Error",
                //title: "Payment confirmation failed",
                icon: "error",
                button: "Got It!",
              });</script>';
      break;

    case 'failure__argument_not_set':
      echo '<script>swal({
                    title: "Error!",
                    text: "Missing compulsory argument",
                    //title: "",
                    icon: "error",
                    button: "Got It!",
                  });</script>';
      break;

    case 'warning':
      break;

    case 'info':
      break;

    case 'advanced':
      echo '<script>swal({
                        text: `Search for a movie. e.g. "La La Land".`,
                        content: "input",
                        button: {
                          text: "Search!",
                          closeModal: false,
                        },
                      })
                      .then(name => {
                        if (!name) throw null;
                       
                        return fetch(`https://itunes.apple.com/search?term=${name}&entity=movie`);
                      })
                      .then(results => {
                        return results.json();
                      })
                      .then(json => {
                        const movie = json.results[0];
                       
                        if (!movie) {
                          return swal("No movie was found!");
                        }
                       
                        const name = movie.trackName;
                        const imageURL = movie.artworkUrl100;
                       
                        swal({
                          title: "Top result:",
                          text: name,
                          icon: imageURL,
                        });
                      })
                      .catch(err => {
                        if (err) {
                          swal("Oh noes!", "The AJAX request failed!", "error");
                        } else {
                          swal.stopLoading();
                          swal.close();
                        }
                      });</script>';
      break;

    case 'getTrueOnButtonClicked':
      echo '<script>swal("Click on either the button or outside the modal.")
            .then((value) => {
              swal(`The returned value is: ${value}`);
            });</script>';

    case 'warnBeforePerformingAction':
      echo '<script>swal({
              title: "Are you sure?",
              text: "Once deleted, you will not be able to recover this imaginary file!",
              icon: "warning",
              buttons: true,
              dangerMode: true,
            })
            .then((willDelete) => {
              if (willDelete) {
                swal("Poof! Your imaginary file has been deleted!", {
                  icon: "success",
                });
              } else {
                swal("Your imaginary file is safe!");
              }
            });</script>';



    default:
      break;
  }
}

function showAlertForOperationDoneOnOtherPage()
{
  //showSweetAlert('success');
  if (isset($_SESSION['alert'])) {
    showSweetAlert($_SESSION['alert']);
    $_SESSION['alert'] = null;
  }
}

function validateEmail($email)
{
  global $db_handle;
  //$response = [];
  $result = $db_handle->selectAllWhere('students', 'email', $email);

  return isset($result) && count($result) > 0;
}

function validateStudentRegNumber($reg)
{
  global $db_handle;
  //$response = [];
  $result = $db_handle->selectAllWhere('students', 'reg_no', $reg);

  return isset($result) && count($result) > 0;
}

function confirmUserEmailAndPassword($postemail, $postpassword, $rememberMe)
{
  global $db_handle;
  //$response = [];
  $result = $db_handle->selectAllWhereWith2Conditions('students', 'email', $postemail, 'password', sha1($postpassword));
  if (isset($result) && count($result) > 0) {
    foreach ($result as $row) {
      extract($row);
      $_SESSION['user_name'] = ucwords(strtolower($first_name)) . " " . ucwords(strtolower($last_name));
      $_SESSION['first_name'] = $first_name;
      $_SESSION['last_name'] = $last_name;
      $_SESSION['full_name'] = $first_name . ' ' . $last_name;
      $_SESSION['student_id'] = $id;
      $_SESSION['student_email'] = $postemail;
      $_SESSION['phone'] = $phone;
      $_SESSION['student_reg'] = $row['reg_no'];

      $_SESSION['log'] = true;

      // //This is the line of code for saving cookies AKA remember me

      // if (isset($remember)) {
      if ($rememberMe == true) {
        //Creates a cookie named "user" with the value "John Doe". The cookie will expire after 30 days (86400 * 30). The "/" means that the cookie is available in entire website (otherwise, select the directory you prefer).

        //setcookie($cookie_name, $cookie_value, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('client_mail', $postemail, time() + (86400 * 30), "/"); // 86400 = 1 day
        setcookie('client_password', $postpassword, time() + (86400 * 30), "/"); // 86400 = 1 day

      } else {
        if (isset($_COOKIE['mem_log'])) {
          setcookie('mem_log', '');
        }
        setcookie("client_mail",  $_SESSION['user_email'], time() + (10 * 365 * 24 * 60 * 60));
        setcookie("client_pass", '', time() + (10 * 365 * 24 * 60 * 60));
      }
    }
    return $result;
  } else {
    return ([['error' => 'Wrong Password']]);
    //return false;
  }
}

function getDepartmentId($departmentName)
{

  global $db_handle;

  $result = $db_handle->selectAllWhere('departments', 'department_name', $departmentName);
  if (isset($result)) {
    return $result[0]['id'];
  } else {
    return false;
  }
}

function createNewStudent($firstName, $lastName, $gender, $email, $phone, $reg, $departmentId, $password)
{
  global $db_handle;

  $firstName = sanitize($firstName, 'clean');
  $lastName = sanitize($lastName, 'clean');
  $email = sanitize($email);
  $gender = sanitize($gender);
  $phone = sanitize($phone);
  $reg = sanitize($reg);
  //$departmentId = getDepartmentID(sanitize($department));
  $password = sha1($password);


  $query = "INSERT INTO `students` (
  `first_name`,
  `last_name`,	
  `gender`,
  `email`,
  `reg_no`,	
  `phone`,
  `department_id`,	
  `password`) VALUES (
    '$firstName',
    '$lastName',
    '$gender',
    '$email',
    '$reg',
    '$phone',
    $departmentId,
    '$password');";
  return $db_handle->runQueryWithoutResponse($query);
}

function getCoursesTakenByStudent($regNo)
{
  global $db_handle;
  //$response = [];
  $result = $db_handle->selectAllWhere('students', 'reg_no', $regNo);

  if (isset($result)) {
    $coursesTaken = json_decode($result[0]['courses_taken'], true);
    sort($coursesTaken,);

    return $coursesTaken;
  } else {
    return false;
  }
}

function getStudentLevel($regNo)
{
  $years = 0;
  $coursesTaken = getCoursesTakenByStudent($regNo);

  // foreach ($coursesTaken as $course) {
  //   if ($course['course_level'] > $course) {
  //     $years++;
  //   }
  // }

  for ($i = 0; $i < count($coursesTaken); $i++) {
    if ($coursesTaken[$i]['course_level'] > $years) {
      $years = $coursesTaken[$i]['course_level'];
    }
  }

  return $years;
}

function countCoursesPerYear($coursesTaken, $level)
{
  $count = 0;
  for ($i = 0; $i < count($coursesTaken); $i++) {
    if ($coursesTaken[$i]['course_level'] == $level) {
      $count++;
    }
  }
  return $count;
}

function getCalenderYearPerLevel($coursesTaken, $level)
{
  for ($i = 0; $i < count($coursesTaken); $i++) {
    if ($coursesTaken[$i]['course_level'] == $level) {
      return $coursesTaken[$i]['year_taken'];
    }
  }
}

function getResultsPerCourseTaken($coursesTaken, $i, $semester)
{
  //echo $i;
  //echo 1;
  global $db_handle;
  //$response = [];
  $result = $db_handle->selectAllWhereWith4Conditions('results', 'course_id', $coursesTaken[$i]['course_id'], 'course_credits', $coursesTaken[$i]['course_credits'], 'year', $coursesTaken[$i]['year_taken'], 'semester', $semester);

  //selectAllWhere('students', 'reg_no', $regNo);
  //echo 2;

  if (isset($result)) {
    // echo 3;
    $courseResultsFull = $result;
    return $courseResultsFull[0];
  } else {
    $result = $db_handle->selectAllWhereWith3Conditions('results', 'course_id', $coursesTaken[$i]['course_id'], 'year', $coursesTaken[$i]['year_taken'], 'semester', $semester);

    //selectAllWhere('students', 'reg_no', $regNo);
    //echo 2;

    if (isset($result)) {
      // echo 3;
      $courseResultsFull = $result;
      return $courseResultsFull[0];
    } else {
      //echo 4;
      return false;
      //return '<br>No result found for this course';
    }
  }
}



function getPersonalResult($results, $regNo)
{
  $resultsObj = json_decode($results, true);
  //$resultsObj = $results;

  foreach ($resultsObj as $result) {
    if ($result['reg_no'] == $regNo) {
      return $result;
    }
  }
  return false;
}

function returnGrade($score)
{
  switch ($score) {
    case ($score < 40):
      return 'F';
      break;

    case ($score >= 40 && $score < 50):
      return 'D';
      break;

    case ($score >= 50 && $score < 60):
      return 'C';
      break;

    case ($score >= 60 && $score < 70):
      return 'B';
      break;

    case ($score >= 70):
      return 'A';
      break;

    default:
      return 'X';
      break;
  }
}





////////////////////////////////////////////////////////////////////////// LECTURER SECTION ////////////////////////////////////////////////////////////////////////////////////////////////////////////////////
#region

function getCoursesHandledByLecturer($id)
{
  global $db_handle;
  //$response = [];
  $result = $db_handle->selectAllWhere('lecturers', 'id', $id);

  if (isset($result)) {
    $coursesTaken = json_decode($result[0]['course_handling'], true);
    sort($coursesTaken);

    createLog('Success', 'getCoursesHandledByLecturer');
    return $coursesTaken;
  } else {
    createLog('Failed', 'getCoursesHandledByLecturer');
    return false;
  }
}


function getCourseInfo($id)
{
  global $db_handle;

  $result = $db_handle->selectAllWhere('courses', 'id', $id);
  if (isset($result)) {
    createLog('Success', 'getCourseInfo');
    return $result[0];
  } else {
    createLog('Failed', 'getCourseInfo');
    return false;
  }
}

function getDepartmentInfo($id)
{
  global $db_handle;

  $result = $db_handle->selectAllWhere('departments', 'id', $id);
  if (isset($result)) {
    createLog('Success', 'getDepartmentInfo');
    return $result[0];
  } else {
    return false;
    createLog('Failed', 'getDepartmentInfo');
  }
}

function getActiveCoursesPerLecturer($id)
{
  global $db_handle;
  //$response = [];
  $result = $db_handle->selectAllWhere('results', 'lecturer_id', $id);

  if (isset($result)) {
    createLog('Success', 'getActivecoursesPerLecturer');
    return $result;
  } else {
    createLog('Failed', 'getActivecoursesPerLecturer');
    return false;
  }
}

function getActivePracticalCoursesPerLecturer($id)
{
  global $db_handle;
  //$response = [];
  $result = $db_handle->selectAllWhereWith2Conditions('results', 'practical_lecturer_id', $id, 'has_practical', 1);

  if (isset($result)) {
    createLog('Success', 'getActivePracticalCoursesPerLecturer');
    return $result;
  } else {
    createLog('Failed', 'getActivePracticalCoursesPerLecturer');
    return false;
  }
}

function createNewCourseSession($lecturerId, $courseId, $courseCredits, $studentSet, $semester, $hasPractical, $practicalLecturerId)
{
  global $db_handle;
  $courseCredits = sanitize($courseCredits, 'clean');
  if ($practicalLecturerId == 'null') {
    $practicalLecturerId = $lecturerId;
  }

  $query = "INSERT INTO `results` (
    `lecturer_id`,
  `course_id`,	
  `course_credits`,
  `set_year`,
  `semester`,	
  `has_practical`,
  `practical_lecturer_id`
  ) VALUES (
    '$lecturerId',
    '$courseId',
    '$courseCredits',
    '$studentSet',
    '$semester',
    '$hasPractical',
    '$practicalLecturerId');";
  if ($db_handle->runQueryWithoutResponse($query)) {
    createLog('Success', 'createNewCourseSession');
    return true;
  } else {
    createLog('Failed', 'createNewCourseSession');
    return false;
  }
}

function getLecturerId($lecturerName)
{
  $lecturerName = sanitize($lecturerName, 'clean');
  //echo ($lecturerName);
  global $db_handle;
  $fullName = explode(' ', $lecturerName);
  //print_r($fullName);
  foreach ($fullName as $name) {
    $result = $db_handle->selectAllWhere('lecturers', 'first_name', $name);
    if (isset($result)) {
      createLog('Success', 'getLecturerId');
      return $result[0]['id'];
    } else {
      $result2 = $db_handle->selectAllWhere('lecturers', 'last_name', $name);
      if (isset($result2)) {
        createLog('Success on new try', 'getLecturerId');
        return $result2[0]['id'];
      }
    }
  }
  createLog('Failed', 'getLecturerId');
  return false;
}

function checkForDuplicateWithTwoColumns($tableName, $col1, $val1, $col2, $val2)
{
  global $db_handle;
  //$response = [];
  $result = $db_handle->selectAllWhereWith2Conditions($tableName, $col1, $val1, $col2, $val2);

  createLog('Ambigous', 'checkForDuplicateWithTwoColumns');
  return isset($result) && count($result) > 0;
}

function checkForDuplicate($tableName, $col1, $val1)
{
  global $db_handle;
  //$response = [];
  $result = $db_handle->selectAllWhere($tableName, $col1, $val1);

  createLog('Ambigous', 'checkForDuplicate');
  return isset($result) && count($result) > 0;
}

function getLecturerName($id)
{
  global $db_handle;

  $result = $db_handle->selectAllWhere('lecturers', 'id', $id);
  if (isset($result)) {
    createLog('Success', 'getLecturerName');
    return $result[0]['first_name'] . ' ' . $result[0]['last_name'];
  } else {
    createLog('Failed', 'getLecturerName');
    return false;
  }
}

function updateCourseSession($resultId, $lecturerId, $courseId, $courseCredits, $studentSet, $semester, $hasPractical, $practicalLecturerId)
{
  global $db_handle;

  $courseCredits = sanitize($courseCredits, 'clean');
  if ($practicalLecturerId == 'null') {
    $practicalLecturerId = $lecturerId;
  }


  $query = "UPDATE `results` SET 
  `set_level` = '$studentSet',
  `course_credits` = $courseCredits,
  `set_year` = '$studentSet',
  `semester` = $semester,	
  `has_practical` = $hasPractical,
  `practical_lecturer_id` = $practicalLecturerId
   WHERE `results`.`id` = $resultId";

  if ($db_handle->runQueryWithoutResponse($query)) {
    createLog('Success', 'updateCourseSession');
    return true;
  } else {
    createLog('Failed', 'updateCourseSession');
    return false;
  }
}

function calculateStudentLevel($set)
{
  $set = explode('/', $set);
  $year = date('Y');
  $level = 0;
  if (isset($set[0])) {
    $level = ($year - $set[0]);
  }
  createLog('Success', 'calculateStudentLevel');
  if ($level < 1) {
    return 1;
  }
  return ($level);
}

function loadSessions()
{
  $limit = 6;
  $year = date('Y') - 6;
  for ($i = 0; $i < 6; $i++) {
    echo '<option value="' . ($year + $i) . '/' . ($year + $i + 1) . '">' . ($year + $i) . '/' . ($year + $i + 1) . ' (' . ($limit)  . '00 Level)</option>';

    // <option value="2017/2018">2017/2018</option>
    // <option value="2018/2019">2018/2019</option>
    // <option value="2019/2020">2019/2020</option>
    // <option value="2020/2021">2020/2021</option>
    // <option value="2021/2022">2021/2022</option>
    // <option value="2022/2023">2022/2023</option>
    $limit--;
  }
  createLog('Success', 'loadSessions');
}

function loadStudentsForParticularCourseSession($session)
{
  global $db_handle;
  $carryOverStudents = [];
  $result = $db_handle->selectAllWhere('students', 'set_year', $session);
  if (isset($result)) {
    foreach ($result as $student) {
      echo '<option value="' . ($student['reg_no']) . '">' . ($student['first_name']) . ' ' . ($student['last_name']) . ' | ' . ($student['reg_no']) . '</option>';
    }
    createLog('Success', 'loadStudentsForParticularCourseSession');
    return true;
  } else {
    createLog('Failed', 'loadStudentsForParticularCourseSession');
    return false;
  }
}

function activateCourse($courseId, $tableId, $level, $setYear)
{
  if (isset($courseId)) {
    $courseInfo = getCourseInfo($courseId);
    $_SESSION['active_course_id'] = $courseId;
    $_SESSION['active_course_table_id'] = $tableId;
    $_SESSION['active_course_name'] = $courseInfo['course_name'];
    $_SESSION['active_course_code'] = $courseInfo['course_code'];
    $_SESSION['active_course_department_id'] = $courseInfo['department_id'];
    $_SESSION['active_course_level'] = $level;
    $_SESSION['active_course_set_year'] = $setYear;
    $_SESSION['active_course_grades'] = getResults($tableId);
  }
  createLog('Success', 'activateCourse');
}

function getResults($resultId)
{

  global $db_handle;

  $result = $db_handle->selectAllWhere('results', 'id', $resultId);
  if (isset($result)) {
    $resultsJson = $result[0]['results'];
    createLog('Success', 'getResults');
    return json_decode($resultsJson, true);
  } else {
    createLog('Failed', 'getResults');
    return false;
  }
}

function returnCompiledResult($resultId, $regNum)
{
  // $id = 2071;
  // $regNum = '2017030180311';
  $results = getResults($resultId);

  $incourseTotal = 0;
  $incourseAbsoluteTotal = 0;

  $examTotal = 0;
  $examAbsoluteTotal = 0;

  foreach ($results as $result) {
    if ($result['reg_num'] == $regNum) {
      $resultIncourse = $result['incourse'];
      $resultExam = $result['exam'];

      foreach ($resultIncourse as $incourse) {
        $incourseAbsoluteTotal += $incourse['total'];
        $incourseTotal += $incourse['score'];
      }

      foreach ($resultExam as $exam) {
        $examAbsoluteTotal += $exam['total'];
        $examTotal += $exam['score'];
      }



      $incourse = 30 * ((($incourseTotal / $incourseAbsoluteTotal) * 100) / 100);
      //echo ceil($incourse);

      //echo '<br>';

      $exam = 70 * ((($incourseTotal / $incourseAbsoluteTotal) * 100) / 100);
      //echo ceil($exam);

      createLog('Successful', 'returnCompiledResult');
      return (array("incourse" => ceil($incourse), "exam" => ceil($exam)));
    }
  }
  createLog('Failed', 'returnCompiledResult');
  return false;
}


function createLog($title, $description)
{
  global $db_handle;

  $title = sanitize($title, 'clean');
  $description = sanitize($description, 'none');

  $query = "INSERT INTO `log` (
    `log_title`,
    `log_description`
         ) VALUES (
    '$title', 
    '$description'
         )";
  return $db_handle->runQueryWithoutResponse($query);
}






#endregion