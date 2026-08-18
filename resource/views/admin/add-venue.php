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
        <form id="form" action="" method="POST">
            <div style="column-gap: 5rem;" class="about__container bd-grid">
                <div>
                    <input type="text" name="hall_name" placeholder="Hall Name" class="contact__input">
                    <select  class="contact__input" name="exam_type" id="">
                        <option value="">Select Exam Type</option>
                        <option value="CBT">CBT</option>
                        <option value="WRITTEN">WRITTEN</option>
                    </select>
                    <!-- <input type="text" name="exam_type" placeholder="Exam Type" class="contact__input"> -->
                </div>
                <div>
                    <!-- <input type="text" name="no_of_seats" placeholder="Number of Seats" class="contact__input"> -->
                </div>
                <input type="submit" name="" value="Save" class="contact__button button">
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
                url: "<?php echo url('admin/venues/add'); ?>",
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
