<?php
pushScript('header_title');
echo $title;
endPushScript();
pushScript('name');
echo $title;
endPushScript();
section('contentDashboard');
?>
 <!--========== CONTENTS ==========-->
 <main>
    <section class="header__container" style="margin: 10px;">
        <p><?php echo $timetable->timetable_name . " - " .$timetable->session_name;;?></p>
        <a href="<?php echo url("staff/timetable/manage/print/".$id); ?>" class="header_image">
            <button class="contact__button button" style="margin-top: 10px;">Print</button>
        </a>
    </section>
    <section>
    <div class="menu section bd-container">
            <div class="menu__content mb-4">
                <table class="table align-items-center mb-0" id="transactions">
                    <thead>
                        <tr>
                            <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Course Name</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Course Code</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Date & Time</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Venue</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Invigilators</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php 
                          foreach ($generated_timetable_list as $generated_timetable) :
                          $course = getCourse($generated_timetable->course_id);
                        ?>
                        <tr>
                          <td class="align-middle text-start text-sm">
                                <p class="text-secondary text-uppercase  mb-0 text-sm">
                                   <?php echo $course->course_name?> 
                                </p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-secondary mb-0 text-sm">
                                  <?php echo $course->course_code?> 
                                </p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-secondary mb-0 text-sm">
                                 
                                  <?php echo $generated_timetable->date?> 
                                </p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-secondary mb-0 text-sm">
                                   <?php echo $generated_timetable->venue?> 
                                </p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-secondary mb-0 text-sm">
                                <?php echo $generated_timetable->invigilators?> 
                                </p>
                            </td>
                            
                        </tr>
                     <?php endforeach; ?> 
                       
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>
<?php
endsection();
extend('pages/layout/app', 'contentDashboard');
