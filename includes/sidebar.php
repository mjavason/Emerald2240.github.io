<div class="sidebar-main sidebar-menu-one sidebar-expand-md sidebar-color">
    <div class="mobile-sidebar-header d-md-none">
        <div class="header-logo">
            <a href="index"><img src="img/logo1.png" alt="logo"></a>
        </div>
    </div>
    <div class="sidebar-menu-content">
        <ul class="nav nav-sidebar-menu sidebar-toggle-view">
            <li class="nav-item sidebar-nav-item">
                <a href="#" class="nav-link"><i class="flaticon-dashboard"></i><span>Dashboard</span></a>
                <ul class="nav sub-group-menu">
                    <li class="nav-item">
                        <a href="index" class="nav-link"><i class="fas fa-angle-right"></i>Admin</a>
                    </li>
                    <li class="nav-item">
                        <a href="all-student" class="nav-link"><i class="fas fa-angle-right"></i>Students</a>
                    </li>
                </ul>
            </li>
            <li class="nav-item sidebar-nav-item">
                <a href="#" class="nav-link"><i class="flaticon-classmates"></i><span>My Students</span></a>
                <ul class="nav sub-group-menu">
                    <li class="nav-item">
                        <a href="all-student" class="nav-link"><i class="fas fa-angle-right"></i>All
                            Students</a>
                    </li>
                    <li class="nav-item">
                        <a href="student-details" class="nav-link"><i class="fas fa-angle-right"></i>Student Details</a>
                    </li>
                    <li class="nav-item">
                        <a href="admit-form" class="nav-link"><i class="fas fa-angle-right"></i>Admission Form</a>
                    </li>
                    <li class="nav-item">
                        <a href="student-promotion" class="nav-link"><i class="fas fa-angle-right"></i>Student Promotion</a>
                    </li>
                </ul>
            </li>


            <li class="nav-item">
                <a href="all-courses" class="nav-link"><i class="flaticon-open-book"></i><span>My Courses</span></a>
            </li>

            <li class="nav-item sidebar-nav-item">
                <a href="#" class="nav-link"><i class="flaticon-maths-class-materials-cross-of-a-pencil-and-a-ruler"></i><span>Class</span></a>
                <ul class="nav sub-group-menu">
                    <li class="nav-item">
                        <a href="all-class" class="nav-link"><i class="fas fa-angle-right"></i>All
                            Classes</a>
                    </li>
                    <li class="nav-item">
                        <a href="add-class" class="nav-link"><i class="fas fa-angle-right"></i>Add New
                            Class</a>
                    </li>
                </ul>
            </li>

            <li class="nav-item">
                <a href="student-attendence" class="nav-link"><i class="flaticon-checklist"></i><span>Attendence</span></a>
            </li>
            <?php if (isset($_SESSION['active_course_id'])) { ?>
                <li class="nav-item sidebar-nav-item">
                    <a href="#" class="nav-link"><i class="flaticon-shopping-list"></i><span>Grades</span></a>
                    <ul class="nav sub-group-menu">
                        <li class="nav-item">
                            <a href="course-grades" class="nav-link"><i class="fas fa-angle-right"></i>View
                                Results</a>
                        </li>
                        <li class="nav-item">
                            <a href="add-incourse" class="nav-link"><i class="fas fa-angle-right"></i>Add Incourse
                                Grades</a>
                        </li>
                        <li class="nav-item">
                            <a href="add-exam" class="nav-link"><i class="fas fa-angle-right"></i>Add Exam
                                Grades</a>
                        </li>
                    </ul>
                </li>
            <?php } ?>


            <li class="nav-item">
                <a href="notice-board" class="nav-link"><i class="flaticon-script"></i><span>Notice</span></a>
            </li>



            <li class="nav-item">
                <a href="account-settings" class="nav-link"><i class="flaticon-settings"></i><span>Account</span></a>
            </li>

            <li class="nav-item">
                <?php if (isset($_SESSION['active_course_id'])) { ?>
                    <a href="account-settings" class="nav-link"><i class="flaticon-settings"></i><span><?= $_SESSION['active_course_name'] ?> <span>(<?= $_SESSION['active_course_code'] ?>)</span></span></a>
                <?php } ?>

            </li>
        </ul>
    </div>
</div>