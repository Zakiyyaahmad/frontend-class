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
    </section>
     <!--========== MENU ==========-->
     <section class="menu section bd-container" id="menu">
        <div class="menu__container">
            <?php foreach ($reports as $report) :?>
                <a href="<?php echo url("admin/reports/reply/".$report->id); ?>"  class="menu__content" >
                    <div>
                        <h3 style="font-size:20px" class="menu__name"><?php echo $report->message;?></h3>
                        <p style="color:green;margin-top:3px;font-size:14px"><?php echo $report->reply;?></p>
                        <span style="color:black" class="menu__detail"><?php echo  date('d M, Y', strtotime($report->time)); ?></span>
                    </div>
                </a>
            <?php endforeach; ?> 
        </div>
    </section>

</main>
<?php
endsection();
extend('pages/layout/app', 'contentDashboard');
