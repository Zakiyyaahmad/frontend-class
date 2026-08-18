<?php
section('contentAuth');
?>
<!--=============== LOGIN IMAGE ===============-->
        <svg class="login__blob" viewBox="0 0 566 840" xmlns="http://www.w3.org/2000/svg">
         <mask id="mask0" mask-type="alpha">
            <path d="M342.407 73.6315C388.53 56.4007 394.378 17.3643 391.538 
            0H566V840H0C14.5385 834.991 100.266 804.436 77.2046 707.263C49.6393 
            591.11 115.306 518.927 176.468 488.873C363.385 397.026 156.98 302.824 
            167.945 179.32C173.46 117.209 284.755 95.1699 342.407 73.6315Z"/>
         </mask>
      
         <g mask="url(#mask0)">
            <path d="M342.407 73.6315C388.53 56.4007 394.378 17.3643 391.538 
            0H566V840H0C14.5385 834.991 100.266 804.436 77.2046 707.263C49.6393 
            591.11 115.306 518.927 176.468 488.873C363.385 397.026 156.98 302.824 
            167.945 179.32C173.46 117.209 284.755 95.1699 342.407 73.6315Z"/>
      
            <!-- Insert your image (recommended size: 1000 x 1200) -->
            <image class="login__img" href="assets/img/bg-img.jpg"/>
         </g>
      </svg>      

      <!--=============== LOGIN ===============-->
      <div class="login container grid" id="loginAccessRegister">
         <!--===== LOGIN ACCESS =====-->
         <div class="login__access">
            <h1 class="login__title">Log in to your account.</h1>
            
            <div class="login__area">
               <form action="" id="login_form" method="POST" class="login__form">
                  <div class="login__content grid">
                     <div class="login__box">
                        <input type="text" id="username" name="username" required placeholder=" " class="login__input">
                        <label for="email" class="login__label">Username</label>
            
                        <i class="ri-mail-fill login__icon"></i>
                     </div>
         
                     <div class="login__box">
                        <input type="password" id="password" name="password" required placeholder=" " class="login__input">
                        <label for="password" class="login__label">Password</label>
            
                        <i class="ri-eye-off-fill login__icon login__password" id="loginPassword"></i>
                     </div>
                  </div>
                  <button type="submit" class="login__button">Login</button>
               </form>
      
               <p class="login__switch">
                   For new Student
                  <button id="loginButtonRegister">Create Account</button>
               </p>
            </div>
         </div>

         <!--===== LOGIN REGISTER =====-->
         <div class="login__register">
            <h1 class="login__title">Create new account.</h1>

            <div class="login__area" >
               <form action="" id="register_form" class="login__form">
                  <div class="login__content grid">
                     <div class="login__box">
                        <input type="text" name="name" id="emailCreate" required placeholder=" " class="login__input">
                        <label for="emailCreate" class="login__label">Name</label>
   
                        <i class="ri-mail-fill login__icon"></i>
                     </div>
                     <div class="login__box">
                        <input type="text" name="admission_number" id="emailCreate" required placeholder=" " class="login__input">
                        <label for="emailCreate" class="login__label">Admission Number</label>
   
                        <i class="ri-mail-fill login__icon"></i>
                     </div>
                     <div class="login__box">
                        <input type="email" name="email" id="emailCreate" required placeholder=" " class="login__input">
                        <label for="emailCreate" class="login__label">Email</label>
   
                        <i class="ri-mail-fill login__icon"></i>
                     </div>
   
                     <div class="login__box">
                        <input type="password" name="password" id="passwordCreate" required placeholder=" " class="login__input">
                        <label for="passwordCreate" class="login__label">Password</label>
   
                        <i class="ri-eye-off-fill login__icon login__password" id="loginPasswordCreate"></i>
                     </div>
                  </div>
   
                  <button type="submit" class="login__button">Create account</button>
               </form>
   
               <p class="login__switch">
                  Already have an account? 
                  <button id="loginButtonAccess">Log In</button>
               </p>
            </div>
         </div>
</div>


<?php
endsection();
pushScript("scripts");
?>
<script type="text/javascript">
    
    $(document).ready(function() {
        //login submit

        $("#login_form").submit(function(e) {
            e.preventDefault();
            let form = $(this);
            //ajax
            let data = form.serialize();
            //ajax
            $.ajax({
                type: "POST",
                url: "<?php echo url('login') ?>",
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
                                window.location.href = response.redirect;
                            } else {
                                //redirect to dashboard
                                window.location.href = "<?php echo url(''); ?>";
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
        $("#register_form").submit(function(e) {
            e.preventDefault();
            let form = $(this);
            //ajax
            let data = form.serialize();
            //ajax
            $.ajax({
                type: "POST",
                url: "<?php echo url('register') ?>",
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
                                window.location.href = response.redirect;
                            } else {
                                //redirect to dashboard
                                window.location.href = "<?php echo url(''); ?>";
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
extend('auth/layout/app', 'contentAuth');
