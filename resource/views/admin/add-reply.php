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
            <div class="menu__content">
                <div style="column-gap: 5rem;" class="about__container bd-grid">
                    <div>
                        <div>
                            <h5>Message</h5>
                            <p><?php echo $report->message;?></p>
                        </div>
                        <div>
                            <h5>Reply</h5>
                            <p><?php echo $report->reply;?></p>
                        </div>
                        <div>
                            <h5>Date</h5>
                            <p><?php echo $report->time;?></p>
                        </div>
                        <div>
                            <h5>Sender</h5>
                            <p>
                                <?php 
                                $user = getUser($report->user_id);
                                echo $user->name;
                                ?>
                            </p>
                        </div>
                    </div>
                   
                </div>
            </div>
            
            <br>
            <div style="padding:10px">
                <label for="">Reply Message</label>
                <textarea class="contact__input" name="reply" id=""><?php echo $report->reply;?></textarea>
            </div> 
            <input style="margin-left:10px;margin-bottom:10px" type="submit" value="Send" class="contact__button button">
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
                url: "<?php echo url('admin/reports/reply/add/'.$id); ?>",
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
