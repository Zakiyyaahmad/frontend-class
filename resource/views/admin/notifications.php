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
        <p>Notifications</p>
        <a href="<?php echo url("admin/notification/add"); ?>" class="header_image">
            <button class="contact__button button" style="margin-top: 10px;">+ Notification</button>
        </a>
    </section>
     <!--========== MENU ==========-->
     <section class="menu section bd-container" id="menu">
        <div class="menu__container">
            <?php foreach ($notifications as $notification) :?>
                <div  class="menu__content" >
                    <div>
                        <h3 class="menu__name"><?php echo $notification->message;?></h3>
                        <span class="menu__detail"><?php echo  date('d M, Y', strtotime($notification->time)); ?></span>
                    </div>
                </div>
            <?php endforeach; ?> 
        </div>
    </section>

</main>
<?php
endsection();
extend('pages/layout/app', 'contentDashboard');
