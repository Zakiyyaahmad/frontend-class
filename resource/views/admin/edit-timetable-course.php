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
        <p><?php echo $title;?></p>
    </section>
    <section class="contact section" id="contact">
        <?php $course = getCourse($generated_timetable->course_id); ?>
        <form id="form" action="<?php echo url('admin/courses/update/'.$id); ?>" method="POST">
            <div style="column-gap: 5rem;" class="about__container bd-grid">
                <div>
                    <div>
                        <label for="">Course Name</label>
                        <input type="text" value="<?php echo $course->course_name; ?>" readonly name="course_name" placeholder="Course Name" class="contact__input">
                    </div>
                    <div>
                        <label for="">Course Code</label>
                        <input type="text" value="<?php echo $course->course_code; ?>" readonly name="course_code" placeholder="Course Code" class="contact__input">
                    </div>
                    <div>
                        <label for="">Invigilators</label>
                        <input type="text" value="<?php echo $generated_timetable->invigilators; ?>" name="invigilators" placeholder="Invigilators" class="contact__input">
                    </div>
                    <div>
                        <label for="">Notification Setting</label>
                        <select  class="contact__input" id="notification" name="notification" id=""> 
                            <option value="0">Off</option>
                            <option value="1">On</option>
                        </select>
                    </div>
                </div>
                <div>
                    <div>
                        <label for="">Venue</label>
                        <input type="text" value="<?php echo $generated_timetable->venue; ?>" name="venue" placeholder="Venue" class="contact__input">
                    </div>
                    <div>
                        <label for="">Exam Type</label>
                        <input type="text" value="<?php echo $course->exam_type; ?>" name="exam_type" placeholder="Exam Type" class="contact__input">
                    </div>
                    <div>
                        <label for="">Date</label>
                        <input type="text" value="<?php echo $generated_timetable->date; ?>" name="date" placeholder="Date" class="contact__input">
                    </div>
                </div>
                
                    <input type="submit" style="margin-bottom:10px" value="Save" class="contact__button button">
            </div>
            
        </form>
    </section>
</main>
<?php
endsection();
pushScript("scripts");
?>
<script type="text/javascript">
    
    $(document).ready(function() {
        //login submit

        $("#form").submit(function(e) {
            e.preventDefault();
            let form = $(this);
            //ajax
            let data = form.serialize();
            //ajax
            $.ajax({
                type: "POST",
                url: "<?php echo url('admin/timetable/course/update/'.$id); ?>",
                data,
                dataType: "json",
                beforeSend: function() {
                    //Swal
                    Swal.fire({
                        title: "Please wait...",
                        text: "Processing your request",
                        showConfirmButton: false,
                        allowOutsideClick: false,
                        didOpen: () => {
                            Swal.showLoading();
                        },
                    });
                },
                success: function(response) {
                    //Swal close
                    Swal.close();
                    //check if response code is 200
                    if (response.code == 200) {
                        //Swal
                        Swal.fire({
                            title: "Success",
                            text: response.message,
                            icon: "success",
                            showConfirmButton: true,
                            allowOutsideClick: false,
                        }).then((result) => {
                            //check if result is true
                            if (result.isConfirmed) {
                                //redirect to dashboard
                                window.location.reload();
                            } 
                        });
                    } else {
                        //Swal
                        Swal.fire({
                            title: "Error",
                            text: response.message,
                            icon: "error",
                            showConfirmButton: true,
                            allowOutsideClick: true
                        });
                    }
                },
                error: function(error) {
                    //Swal close
                    Swal.close();
                    //Swal
                    Swal.fire({
                        title: "Error",
                        text: "An error occured",
                        icon: "error",
                        showConfirmButton: true,
                        allowOutsideClick: true
                    });
                }
            });
            
        });        
    });
</script>
<?php
endPushScript();
extend('pages/layout/app', 'contentDashboard');
