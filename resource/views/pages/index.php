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
    
    <section>
    <div class="menu section bd-container">
            <div class="menu__content mb-4">
                <table class="table align-items-center mb-0" id="transactions">
                    <thead>
                        <tr>
                            <th class="text-start text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Name</th>
                            <th class="text-center text-uppercase text-secondary text-xxs font-weight-bolder opacity-7">Session</th>
                            <th class="text-uppercase text-secondary text-xxs font-weight-bolder opacity-7 ps-2">Status</th>
                            
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
                                    <a href="<?php echo url(auth()->getRole() ."/timetable/".$timetable->id); ?>" class="align-middle">
                                        <button class="button" class="text-secondary mb-0 text-sm">view</button>
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
extend('pages/layout/app', 'contentDashboard');
