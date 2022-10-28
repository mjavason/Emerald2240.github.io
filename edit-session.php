<?php
require_once('config/connect.php');
require_once('functions/functions.php');

if (isset($_GET['course_id']) && isset($_GET['semester']) && isset($_GET['course_credits']) && isset($_GET['set']) && isset($_GET['practical_lecturer_name']) && isset($_GET['edit'])) {
    $_SESSION['course_id'] = $_GET['course_id'];
    if (isset($_GET['edit'])) {
        $_SESSION['course_edit'] = true;
    } else {
        $_SESSION['course_edit'] = false;
    }
} else {
    gotoPage('active-courses');
}
?>
<!doctype html>
<html class="no-js" lang="">

<head>
    <title>AKKHOR | Edit Session</title>
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
                    <h3>Course Sessions</h3>
                    <ul>
                        <li>
                            <a href="index">Home</a>
                        </li>
                        <li>Edit Course Session</li>
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
                                        <h3>Edit <?= $_GET['set'] ?> Course Session</h3>
                                    </div>
                                    <div class="dropdown">
                                        <a class="dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-expanded="false">...</a>

                                        <div class="dropdown-menu dropdown-menu-right">
                                            <a class="dropdown-item" href="#"><i class="fas fa-times text-orange-red"></i>Close</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-cogs text-dark-pastel-green"></i>Edit</a>
                                            <a class="dropdown-item" href="#"><i class="fas fa-redo-alt text-orange-peel"></i>Refresh</a>
                                        </div>
                                    </div>
                                </div>
                                <form class="new-added-form" method="POST" action="test">
                                    <div class="row">
                                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                            <label>Class/Set <?= '(' . $_GET['set'] . ')'  ?>)</label>
                                            <select id="session_select" name="session" class="select2">
                                                <option value="">Please Select</option>
                                                <option value="2016/2017">2016/2017</option>
                                                <option value="2017/2018">2017/2018</option>
                                                <option value="2018/2019">2018/2019</option>
                                                <option value="2019/2020">2019/2020</option>
                                                <option value="2020/2021">2020/2021</option>
                                                <option value="2021/2022">2021/2022</option>
                                                <option value="2022/2023">2021/2022</option>
                                            </select>
                                        </div>
                                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                            <label>Credits</label>
                                            <input value="<?= $_GET['course_credits'] ?>" class="form-control" type="number" name="course_credits" id="course_credits">
                                        </div>

                                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                            <label>Semester <?= '(' . $_GET['semester'] . ')' ?></label>
                                            <select name="semester" id="semester_select" class="select2">
                                                <option value="">Please Select</option>
                                                <option value="1">1</option>
                                                <option value="2">2</option>
                                            </select>
                                        </div>
                                        <!-- <div class="m-4 col-12-xxxl col-lg-6 col-12 form-group">

                                        </div> -->

                                        <!-- <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                            <label>Practicals Included</label>
                                            <input type="checkbox" class="form-control" name="has_practicals" id="has_practicals">
                                        </div> -->
                                        <div class="col-12-xxxl col-lg-6 col-12 form-group">
                                            <label>Practical Lecturer (Leave blank if no practicals exist or Add Personal name if you handle it yourself)</label>
                                            <input onkeyup='simpleAsyncSearch("functions/ajax.php", "lecturer_search_input")' id="lecturer_search_input" name="practical_lecturer_name" type="text" placeholder="" class="form-control" value="<?= $_GET['practical_lecturer_name'] ?>">
                                            <div class="" id="line"></div>
                                            <!-- line loader end-->
                                            <ul id="lecturer_list">
                                                <!-- <li data-dialog="somedialog" class="trigger" class="trigger lecturer_item"> <a href="#">Item1</a> </li>
                                                <li class="lecturer_item"><a href="#">Item1</a></li>
                                                <li class="lecturer_item"><a href="#">Item1</a></li>
                                                </li> -->

                                            </ul>
                                        </div>


                                    </div>
                                    <div class="mt-3">
                                        <button type="button" onclick="createNewCourseSession('functions/createNewCourseSession', getInputValuesAndReturnTheirContentAsJson(['session_select', 'course_credits', 'semester_select', 'lecturer_search_input']))" id="new_session_button" class="btn-fill-lg btn-gradient-yellow btn-hover-bluedark">Save</button>
                                        <!-- <button type="reset" onclick="reset()" class="btn-fill-lg bg-blue-dark btn-hover-yellow">Reset</button> -->
                                    </div>
                                </form>
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
    <!-- Date Picker Js -->
    <script src="js/datepicker.min.js"></script>
    <!-- Custom Js -->
    <script src="js/main.js"></script>
    <?php require_once('includes/js_imports.php') ?>

</body>

</html>