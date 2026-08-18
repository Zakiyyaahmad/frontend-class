<!DOCTYPE html>
<html>
<head>
<style>
table {
  font-family: arial, sans-serif;
  border-collapse: collapse;
  width: 100%;
}

td, th {
  border: 1px solid #dddddd;
  text-align: left;
  padding: 8px;
}

/* tr:nth-child(even) {
  background-color: #dddddd;
} */
</style>
</head>
<body>
<div style="text-align:center">
  <h2 style="margin-bottom:1px">USMANU DANFODIYO UNIVERSITY SOKOTO</h2>
  <h3 style="margin-top:0px;margin-bottom:1px">DEPARTMENT OF COMPUTER SCIENCE TIME TABLE</h3>
  <p><?php echo $timetable->timetable_name . " - " .$timetable->session_name;;?></p>
</div>

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
                                  <?php echo $generated_timetable->time." ".$generated_timetable->date?> 
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


</body>
</html>

