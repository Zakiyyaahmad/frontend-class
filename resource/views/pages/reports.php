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
        <p>Reports</p>
        <a href="<?php echo url("student/reports/add"); ?>" class="header_image">
            <button class="contact__button button" style="margin-top: 10px;">+ Report</button>
        </a>
    </section>
     <!--========== MENU ==========-->
     <section class="menu section bd-container" id="menu">
        <div class="menu__container">
            <?php foreach ($reports as $report) :?>
                <div  class="menu__content" >
                    <div>
                        <h3 style="font-size:20px" class="menu__name"><?php echo $report->message;?></h3>
                        <p style="color:green;margin-top:3px;font-size:14px"><?php echo $report->reply;?></p>
                        <span class="menu__detail"><?php echo  date('d M, Y', strtotime($report->time)); ?></span>
                    </div>
                </div>
            <?php endforeach; ?> 
        </div>
    </section>

</main>
<?php
endsection();
extend('pages/layout/app', 'contentDashboard');
