<?php
require_once('config/connect.php');
require_once('functions/functions.php');

if (!isset($_SESSION['super_log'])) {
    gotoPage("../index");
}
?>
<!doctype html>
<html class="no-js" lang="">


<head>
    <title>AKKHOR | My Active Courses</title>
    <meta name="description" content="">
    <?php require_once('includes/head.php'); ?>
</head>

<body>
    <!-- Preloader Start Here -->
    <div id="preloader"></div>
    <!-- Preloader End Here -->
    <div id="wrapper" class="wrapper bg-ash">
        <!-- Header Menu Area Start Here -->
        <?php require_once('includes/header.php') ?>
        <!-- Header Menu Area End Here -->
        <!-- Page Area Start Here -->
        <div class="dashboard-page-one">
            <!-- Sidebar Area Start Here -->
            <?php require_once('includes/sidebar.php') ?>
            <!-- Sidebar Area End Here -->
            <div class="dashboard-content-one">
                <!-- Breadcubs Area Start Here -->
                <div class="breadcrumbs-area">
                    <h3>My Active Courses</h3>
                    <ul>
                        <li>
                            <a href="index">Home</a>
                        </li>
                        <li>Active Courses</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <!-- All Subjects Area Start Here -->
                <div class="row">
                    <div class="col-8-xxxl col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Active Courses and Sessions</h3>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">...</a>
                                        <!-- 
                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                        </div> -->
                                    </div>
                                </div>

                                <div class="table-responsive">
                                    <table class="table display data-table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th>
                                                    <div class="form-chec">
                                                        <!-- <input type="checkbox" class="form-check-input checkAll"> -->
                                                        <label class="form-check-label">ID</label>
                                                    </div>
                                                </th>
                                                <th>Code</th>
                                                <th>Name</th>
                                                <th>Credits</th>
                                                <th>Level</th>
                                                <th>Class Set</th>
                                                <th></th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php $activeCourses = getActiveCoursesPerLecturer($_SESSION['lecturer_id']);
                                            if ($activeCourses) {
                                                foreach ($activeCourses as $course) {
                                                    $courseInfo = getCourseInfo($course['course_id']);
                                                    if ($courseInfo) {
                                            ?>
                                                        <?php
                                                        if (isset($_SESSION['active_course_id'])) {
                                                            if ($_SESSION['active_course_id'] == $course['course_id'] && $_SESSION['active_course_table_id'] == $course['id']) { ?>
                                                                <tr class="text-success">
                                                                <?php } else { ?>
                                                                <tr>
                                                                <?php }
                                                        } else { ?>
                                                                <tr>
                                                                <?php } ?>

                                                                <td>
                                                                    <div class="form-chec">
                                                                        <!-- <input type="checkbox" class="form-check-input"> -->
                                                                        <label class="form-check-label">#<?= $course['id'] ?></label>
                                                                    </div>
                                                                </td>
                                                                <td><?= $courseInfo['course_code'] ?></td>
                                                                <td><?= $courseInfo['course_name'] ?></td>
                                                                <td><?= $course['course_credits'] ?></td>
                                                                <td><?= calculateStudentLevel($course['set_year']) ?>00</td>
                                                                <td><?= $course['set_year'] ?></td>
                                                                <td>
                                                                    <div class="dropdown">
                                                                        <a href="#" class="dropdown-toggle" data-toggle="dropdown" aria-expanded="false">
                                                                            <span class="flaticon-more-button-of-three-dots"></span>
                                                                        </a>
                                                                        <div class="dropdown-menu dropdown-menu-right">
                                                                            <a class="dropdown-item" href="grade?result_id=<?= $course['id'] ?>&course_id=<?= $course['course_id'] ?>&semester=<?= $course['semester'] ?>&course_credits=<?= $course['course_credits'] ?>&set=<?= $course['set_year'] ?>&practical_lecturer_name=<?= getLecturerName($course['practical_lecturer_id']) ?>"><i class="fas fa-plus text-primary"></i>Add/Edit Incourse Grades</a>
                                                                            <a class="dropdown-item" href="grade-exam?result_id=<?= $course['id'] ?>&course_id=<?= $course['course_id'] ?>&semester=<?= $course['semester'] ?>&course_credits=<?= $course['course_credits'] ?>&set=<?= $course['set_year'] ?>&practical_lecturer_name=<?= getLecturerName($course['practical_lecturer_id']) ?>"><i class="fas fa-plus text-primary"></i>Add/Edit Exam Grades</a>
                                                                            <a class="dropdown-item" href="edit-session?result_id=<?= $course['id'] ?>&course_id=<?= $course['course_id'] ?>&semester=<?= $course['semester'] ?>&course_credits=<?= $course['course_credits'] ?>&set=<?= $course['set_year'] ?>&practical_lecturer_name=<?= getLecturerName($course['practical_lecturer_id']) ?>&edit=1"><i class="fas fa-pen text-dark-pastel-green"></i>Edit</a>
                                                                            <a class="dropdown-item" href="course-grades?result_id=<?= $course['id'] ?>&course_id=<?= $course['course_id'] ?>&semester=<?= $course['semester'] ?>&course_credits=<?= $course['course_credits'] ?>&set=<?= $course['set_year'] ?>&practical_lecturer_name=<?= getLecturerName($course['practical_lecturer_id']) ?>"><i class="fas fa-calendar text-dark-pastel-green"></i>View Grades</a>
                                                                            <a class="dropdown-item" onclick="getConfirmation('Deactivate Course Session', 'Are you sure you want to close this session? Once deactivated, it cannot be updated.', 'functions/deactivateCourseSession?result_id=<?= $course['id'] ?>')"><i class="fas fa-lock text-danger"></i>Close/Seal Permanently</a>
                                                                            <?php
                                                                            if (isset($_SESSION['active_course_id'])) {
                                                                                if ($_SESSION['active_course_id'] == $course['course_id'] && $_SESSION['active_course_table_id'] == $course['id']) { ?>
                                                                                <?php } else { ?>
                                                                                    <a class="dropdown-item" href="functions/activate-course.php?result_id=<?= $course['id'] ?>&course_id=<?= $course['course_id'] ?>&semester=<?= $course['semester'] ?>&course_credits=<?= $course['course_credits'] ?>&set=<?= $course['set_year'] ?>&practical_lecturer_name=<?= getLecturerName($course['practical_lecturer_id']) ?>"><i class="fas fa-check text-orange-peel"></i>Work On</a>
                                                                                <?php }
                                                                            } else { ?>
                                                                                <a class="dropdown-item" href="functions/activate-course.php?result_id=<?= $course['id'] ?>&course_id=<?= $course['course_id'] ?>&semester=<?= $course['semester'] ?>&course_credits=<?= $course['course_credits'] ?>&set=<?= $course['set_year'] ?>&practical_lecturer_name=<?= getLecturerName($course['practical_lecturer_id']) ?>"><i class="fas fa-check text-orange-peel"></i>Work On</a>
                                                                            <?php } ?>
                                                                        </div>
                                                                    </div>
                                                                </td>
                                                                </tr>
                                                    <?php    }
                                                }
                                            } ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- All Subjects Area End Here -->
                <footer class="footer-wrap-layout1">
                    <?php require_once('includes/footer.php') ?>
                </footer>
            </div>
        </div>
        <!-- Page Area End Here -->
    </div>
    <!-- jquery-->
    <script src="js/jquery-3.3.1.min.js"></script>
    <!-- Plugins js -->
    <script src="js/plugins.js"></script>
    <!-- Popper js -->
    <script src="js/popper.min.js"></script>
    <!-- Bootstrap js -->
    <script src="js/bootstrap.min.js"></script>
    <!-- Select 2 Js -->
    <script src="js/select2.min.js"></script>
    <!-- Scroll Up Js -->
    <script src="js/jquery.scrollUp.min.js"></script>
    <!-- Data Table Js -->
    <script src="js/jquery.dataTables.min.js"></script>
    <!-- Custom Js -->
    <script src="js/main.js"></script>
    <?php require_once('includes/js_imports.php') ?>

</body>


</html>