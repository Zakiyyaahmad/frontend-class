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
        <a href="<?php echo url("admin/timetable/add"); ?>" class="header_image">
            <button class="contact__button button" style="margin-top: 10px;">+ TimeTable</button>
        </a>
        <div class="header__search">
            <input type="search" placeholder="Search" class="header__input">
            <i class='bx bx-search header__icon'></i>
        </div>
    </section>
    <section>
    <div class="menu section bd-container">
            <div class="menu__content mb-4">
                <table class="table align-items-center mb-0" id="timetables">
                    <thead>
                        <tr>
                            <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Session</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                         foreach ($timetables as $timetable) :
                        ?>
                        <tr>
                          <td class="align-middle text-start text-sm">
                                <p class="text-secondary text-uppercase  mb-0 text-sm">
                                   <?php echo $timetable->timetable_name;?>
                                </p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-secondary mb-0 text-sm">
                                <?php echo $timetable->session_name;?>
                                </p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="align-middle text-secondary mb-0 text-sm">
                                    <a href="<?php echo url('admin/timetable/manage/'.$timetable->id); ?>" class="align-middle">
                                        <button class="button" class="text-secondary mb-0 text-sm">Manage</button>
                                    </a>
                                </p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="align-middle text-secondary mb-0 text-sm">
                                    <a href="<?php echo url('admin/timetable/edit/'.$timetable->id); ?>" class="align-middle">
                                        <button class="button" class="text-secondary mb-0 text-sm">Edit</button>
                                    </a>
                                </p>
                            </td>
                        </tr>
                        <?php
                          endforeach;
                        ?> 
                        
                        
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>
<?php
endsection();
pushScript("scripts");
?>
<script src="<?php echo assets('assets/js/datatables.js') ?>"></script>
<script>
    $(document).ready(function() {
        // const dataTableSearch = new simpleDatatables.DataTable("#timetables", {
        //     searchable: true,
        //     fixedHeight: true
        // });
    });
</script>
<?php
endPushScript();
extend('pages/layout/app', 'contentDashboard');
