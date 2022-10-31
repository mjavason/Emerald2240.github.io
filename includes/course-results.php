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
                             <th>Quiz</th>
                             <th>Assignment</th>
                             <th>Attendance</th>
                             <th>Project</th>
                             <th>Practicals</th>
                             <th>Exams</th>
                         </tr>
                     </thead>
                     <tbody>
                         <?php
                            foreach ($results as $result) { ?>
                             <tr>
                                 <td class="text-left"><?= getStudentName($result['reg_num']) ?> (<?= $result['reg_num'] ?>)</td>
                                 <?php
                                    if (isset($result['incourse'])) {
                                        foreach ($result['incourse'] as $incourse) {
                                    ?>
                                         <!-- Quiz -->
                                         <?php if ($incourse['title'] == "Quiz") { ?>
                                             <td class="text-success"><?= $incourse['score'] ?></td>
                                         <?php } else {
                                                echo ('<td class="text-success"><i class="fas fa-times text-danger"></i></td>');
                                            }
                                            ?>

                                         <!-- Assignment -->
                                         <?php if ($incourse['title'] == "Assignment") { ?>
                                             <td class="text-success"><?= $incourse['score'] ?></td>
                                         <?php } else {
                                                echo ('<td class="text-success"><i class="fas fa-times text-danger"></i></td>');
                                            } ?>

                                         <!-- Attendance -->
                                         <?php if ($incourse['title'] == "Attendance") { ?>
                                             <td class="text-success"><?= $incourse['score'] ?></td>
                                         <?php } else {
                                                echo ('<td class="text-success"><i class="fas fa-times text-danger"></i></td>');
                                            } ?>

                                         <!-- Project -->
                                         <?php if ($incourse['title'] == "Project") { ?>
                                             <td class="text-success"><?= $incourse['score'] ?></td>
                                         <?php } else {
                                                echo ('<td class="text-success"><i class="fas fa-times text-danger"></i></td>');
                                            } ?>

                                         <!-- Practicals -->
                                         <?php if ($incourse['title'] == "Practicals") { ?>
                                             <td class="text-success"><?= $incourse['score'] ?></td>
                                 <?php } else {
                                                echo ('<td class="text-success"><i class="fas fa-times text-danger"></i></td>');
                                            }
                                        }
                                    } else {
                                        echo ('<td class="text-success"><i class="fas fa-times text-danger"></i></td>');
                                        echo ('<td class="text-success"><i class="fas fa-times text-danger"></i></td>');
                                        echo ('<td class="text-success"><i class="fas fa-times text-danger"></i></td>');
                                        echo ('<td class="text-success"><i class="fas fa-times text-danger"></i></td>');
                                        echo ('<td class="text-success"><i class="fas fa-times text-danger"></i></td>');
                                    } ?>

                                 <?php if (isset($result['exam'])) {
                                        $exam = $result['exam'][0];
                                    ?>
                                     <?php if ($exam['title'] == "Exam") { ?>
                                         <td class="text-success"><?= $exam['score'] ?></td>
                                     <?php } else {
                                            echo ('<td class="text-success"><i class="fas fa-times text-danger"></i></td>');
                                        } ?>
                                 <?php
                                    } else { ?>
                                     <td class="text-success"><i class="fas fa-times text-danger"></i></td>
                             </tr>
                     <?php }
                                } ?>
                     </tbody>
                     <?php ?>
                 </table>

             </div>
         </div>
     </div>
 </div>