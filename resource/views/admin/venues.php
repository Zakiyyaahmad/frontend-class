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
        <a href="<?php echo url("admin/venues/add"); ?>" class="header_image">
            <button class="contact__button button" style="margin-top: 10px;">+ Venue</button>
        </a>
        <div class="header__search">
            <input type="search" placeholder="Search" class="header__input">
            <i class='bx bx-search header__icon'></i>
        </div>
       
    </section>
    <section>
    <div class="menu section bd-container">
            <div class="menu__content mb-4">
                <table class="table align-items-center mb-0" id="transactions">
                    <thead>
                        <tr>
                            <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Hall Name</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Exam-Type</th>
                            <!-- <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Number of Seats</th> -->
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Action</th>
                            
                        </tr>
                    </thead>
                    <tbody>
                     <?php foreach ($venues as $venue) :?>
                        <tr>
                          <td class="align-middle text-start text-sm">
                                <p class="text-secondary text-uppercase  mb-0 text-sm">
                                  <?php echo $venue->hall_name;?>
                                </p>
                            </td>
                            <td class="align-middle text-center text-sm">
                                <p class="text-secondary mb-0 text-sm">
                                  <?php echo $venue->exam_type;?>
                                </p>
                            </td>
                            <!-- <td class="align-middle text-center text-sm">
                                <p class="text-secondary mb-0 text-sm">
                                  <?php echo $venue->no_of_seats;?>
                                </p>
                            </td> -->
                            <td class="align-middle text-center text-sm">
                                <p class="align-middle text-secondary mb-0 text-sm">
                                    <a href="<?php echo url('admin/venues/edit/'.$venue->id); ?>" class="align-middle">
                                        <button class="button" class="text-secondary mb-0 text-sm">Edit</button>
                                    </a>
                                </p>
                            </td>
                           
                        </tr>
                     <?php endforeach; ?> 
                    </tbody>
                </table>
            </div>
        </div>
    </section>
</main>
<?php
endsection();
extend('pages/layout/app', 'contentDashboard');
