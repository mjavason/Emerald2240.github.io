<?php
require_once('config/connect.php');
require_once('functions/functions.php');

if (isset($_GET['result_id']) && isset($_GET['course_id']) && isset($_GET['semester']) && isset($_GET['course_credits']) && isset($_GET['set']) && isset($_GET['practical_lecturer_name'])) {
    activateCourse($_GET['course_id'], $_GET['result_id'], calculateStudentLevel($_GET['set']),  $_GET['set']);
} elseif (isset($_SESSION['active_course_id'])) {
} else {
    gotoPage('active-courses');
}

?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <title>AKKHOR | Incourse Grade</title>
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
                    <h3>Incourse</h3>
                    <ul>
                        <li>
                            <a href="index">Home</a>
                        </li>
                        <li>Add Incourse</li>
                    </ul>
                </div>
                <!-- Breadcubs Area End Here -->
                <div class="row">
                    <!-- Exam Grade Add Area Start Here -->
                    <div class="col-4-xxxl col-12">
                        <div class="card height-auto">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Add New Incourse Grade</h3>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">...</a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="edit-incourse"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                            <a class="dropdown-item" href="delete-incourse"><i class="fas fa-times text-orange-red"></i>Delete</a>
                                        </div>
                                    </div>
                                </div>
                                <form class="new-added-form">
                                    <div class="row">
                                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                            <label>Incourse Name</label>
                                            <input type="text" id="grade_title" placeholder="**Quiz 1" class="form-control">
                                        </div>

                                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                            <label>Score Total</label>
                                            <input id="grade_total" type="text" placeholder="" class="form-control">
                                        </div>

                                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                            <label>Student</label>
                                            <select id="student_reg_number" class="select2">
                                                <option value="">Please Select</option>
                                                <?php loadStudentsForParticularCourseSession($_SESSION['active_course_set_year']) ?>
                                                <!-- <option value="1">Orji Michael</option>
                                                <option value="2">Aruogu Chidiebube</option>
                                                <option value="3">Monanu Ifenna</option>
                                                <option value="4">Okorie Oluebube</option>
                                                <option value="5">Onuoha Stephanie</option> -->
                                            </select>
                                        </div>

                                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                            <label>Student Score</label>
                                            <input id="student_score" type="text" placeholder="" class="form-control">
                                        </div>
                                        <!-- <div class="col-12 form-group">
                                            <label>Comments</label>
                                            <textarea class="textarea form-control" name="message" id="form-message" cols="10" rows="4"></textarea>
                                        </div> -->
                                        <div class="col-12 form-group mg-t-8">
                                            <button type="button" onclick="updateResults('functions/updateResults', getInputValuesAndReturnTheirContentAsJson(['grade_title', 'grade_total', 'student_reg_number', 'student_score']))" id="add_incourse_button" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                            <!-- <button type="reset" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button> -->
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                    <!-- Student Grade Area Start Here -->
                    <div class="col-12">
                        <div class="card">
                            <div class="card-body">
                                <div class="heading-layout1">
                                    <div class="item-title">
                                        <h3>Grade Sheet of <?= $_SESSION['active_course_set_year'] ?> | <?= $_SESSION['active_course_name'] ?> (<?= $_SESSION['active_course_code'] ?>) </h3>
                                    </div>
                                    <!-- <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">...</a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                        </div>
                                    </div> -->
                                </div>
                                <div class="table-responsive">
                                    <?php
                                    $results = $_SESSION['active_course_grades'];
                                    ?>
                                    <table class="table bs-table table-striped table-bordered text-nowrap display data-table text-nowrap">
                                        <thead>
                                            <tr>
                                                <th class="text-left">Students</th>
                                                <?php
                                                if (isset($results[0]['incourse'])) {
                                                    foreach ($results[0]['incourse'] as $incourse) {
                                                ?>
                                                        <th><?= $incourse['title'] ?></th>
                                                <?php }
                                                } ?>
                                                <?php
                                                if (isset($results[0]['exam'])) {
                                                    foreach ($results[0]['exam'] as $exam) {
                                                ?>
                                                        <th><?= $exam['title'] ?></th>
                                                <?php }
                                                } ?>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($results as $result) { ?>
                                                <tr>
                                                    <td class="text-left"><?= getStudentName($result['reg_num']) ?> (<?= $result['reg_num'] ?>)</td>

                                                    <?php
                                                    if (isset($results[0]['incourse'])) {

                                                        foreach ($result['incourse'] as $incourse) {
                                                    ?>

                                                            <td class="text-success"><?= $incourse['score'] ?></td>
                                                        <?php }
                                                    }
                                                    if (isset($results[0]['exam'])) {
                                                        foreach ($result['exam'] as $exam) {
                                                        ?>

                                                            <td class="text-success"><?= $exam['score'] ?></td>
                                                    <?php }
                                                    } ?>
                                                </tr>
                                            <?php } ?>
                                        </tbody>
                                        <?php ?>
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