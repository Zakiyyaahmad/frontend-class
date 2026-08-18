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
                    <input type="text" placeholder="Name" name="timetable_name" class="contact__input">
                    <input type="text" placeholder="Session" name="session_name" class="contact__input">  
                    <select  class="contact__input" id="type" name="type" id="">
                        <option value="">Select Type</option>
                        <option value="0">Without Date</option>
                        <option value="1">With Date</option>
                    </select>
                </div>
    
                <div id="dates">
                    <input type="date" placeholder="Start Date" name="start_date" class="contact__input">
                    <input type="date" placeholder="End Date" name="end_date" class="contact__input">
                </div>
                
            </div>
            <br>
            <input type="submit" style="margin-left:12px;" value="Save" class="contact__button button">
                
            
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

        $("#dates").hide();
        $("#type").on("change",function(){
           var type =  $(this).val();
           if(type==0){
                $("#dates").hide();
           }else{
                $("#dates").show();
           }
        });
        $("#form").submit(function(e) {
            e.preventDefault();
            let form = $(this);
            //ajax
            let data = form.serialize();
            //ajax
            $.ajax({
                type: "POST",
                url: "<?php echo url('admin/timetable/add'); ?>",
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
