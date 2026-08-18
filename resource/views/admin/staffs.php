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
        <a href="<?php echo url("admin/staffs/add"); ?>" class="header_image">
            <button class="contact__button button" style="margin-top: 10px;">+ Staff</button>
        </a>
        <div class="header__search">
            <input type="search" placeholder="Search Staff" class="header__input">
            <i class='bx bx-search header__icon'></i>
        </div>
    </section>
     <!--========== MENU ==========-->
     <section class="menu section bd-container" id="menu">
        <div class="menu__container">
            <?php foreach ($staffs as $staff) :?>
                <a href="<?php echo url('admin/staffs/edit/'.$staff->id); ?>" class="menu__content">
                    <img src="<?php echo assets('assets/img/perfil.png')?>" alt="" class="menu__img">
                    <div>
                        <h3 class="menu__name"><?php echo $staff->name?></h3>
                        <span style="color:black" class="menu__detail"><?php echo $staff->rank?></span>
                    </div>
                </a>
            <?php endforeach; ?> 
        </div>
    </section>

</main>
<?php
endsection();
extend('pages/layout/app', 'contentDashboard');
