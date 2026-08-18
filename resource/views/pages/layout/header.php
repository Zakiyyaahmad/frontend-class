<!DOCTYPE html>
    <html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">

        <!--========== BOX ICONS ==========-->
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/boxicons@latest/css/boxicons.min.css">
        <!-- <link rel="stylesheet" href="<?php echo assets('assets/css/boxicons.min.css') ?>"> -->
        <!--========== CSS ==========-->
        <link rel="stylesheet" href="<?php echo assets('assets/css/styles.css') ?>">
        <link rel="stylesheet" href="<?php echo assets('assets/css/style.min.css') ?>">
        
        <title><?php ade_yield('header_title') ?> - <?php echo site_name(); ?> </title>
        
    </head>
    <body>
        <!--========== HEADER ==========-->
        <header class="header">
            <div class="header__container">
                <!-- <a href="<?php echo url("profile"); ?>" class="header__img">
                    <img src="assets/img/perfil.jpg" class="header__img" alt="" >
                </a> -->

                <a href="" class="header__logo"><?php echo site_name(); ?></a>
    
                <!-- <div class="header__search">
                    <input type="search" placeholder="Search" class="header__input">
                    <i class='bx bx-search header__icon'></i>
                </div> -->
    
                <div class="header__toggle">
                    <i class='bx bx-menu' id="header-toggle"></i>
                </div>
            </div>
        </header>

        <!--========== NAV ==========-->
        <div class="nav" id="navbar">
            <nav class="nav__container">
                <div>
                    <a href="#" class="nav__link nav__logo">
                        <i class='bx bxs-disc nav__icon' ></i>
                        <span class="nav__logo-name"><?php ade_yield('name'); ?></span>
                    </a>
    
                    <div class="nav__list">
                        <div class="nav__items">
                            <h3 class="nav__subtitle">Pages</h3>
                            <!-- <div class="nav__dropdown">
                                <a href="<?php echo url(""); ?>" class="nav__link">
                                    <i class='bx bx-home nav__icon' ></i>
                                    <span class="nav__name">Home</span>
                                    <i class='bx bx-chevron-down nav__icon nav__dropdown-icon'></i>
                                </a>
                                
                                <div class="nav__dropdown-collapse">
                                    <div class="nav__dropdown-content">
                                        <a href="#" class="nav__dropdown-item">TimeTable Lists</a>
                                        <a href="#" class="nav__dropdown-item">Add TimeTable Lists</a>
                                        
                                    </div>
                                </div>
                            </div> -->

                            <a href="<?php echo url(auth()->getRole() . '/'); ?>" class="nav__link">
                                <i class='bx bx-home nav__icon' ></i>
                                <span class="nav__name">Home</span>       
                            </a>
                            <?php 
                               if (auth()->getRole() == 'admin') :
                            ?>
                            <a href="<?php echo url(auth()->getRole() . '/reports'); ?>" class="nav__link">
                                <i class='bx bx-edit nav__icon' ></i>
                                <span class="nav__name">Reports</span>
                            </a>
                            <a href="<?php echo url(auth()->getRole() . '/courses'); ?>" class="nav__link">
                                <i class='bx bx-file nav__icon' ></i>
                                <span class="nav__name">Courses</span>
                            </a>
                            <a href="<?php echo url(auth()->getRole() . '/staffs'); ?>" class="nav__link">
                                <i class='bx bx-book nav__icon' ></i>
                                <span class="nav__name">Staffs</span>
                            </a>
                            <a href="<?php echo url(auth()->getRole() . '/students'); ?>" class="nav__link">
                                <i class='bx bx-compass nav__icon' ></i>
                                <span class="nav__name">Students</span>
                            </a>
                            <a href="<?php echo url(auth()->getRole() . '/venues'); ?>" class="nav__link">
                                <i class='bx bx-bookmark nav__icon' ></i>
                                <span class="nav__name">Venues</span>
                            </a>
                            <a href="<?php echo url(auth()->getRole() . '/notifications'); ?>" class="nav__link">
                                <i class='bx bx-bell nav__icon' ></i>
                                <span class="nav__name">Notifications</span>
                            </a>
                            <?php
                             endif;
                            ?>
                            <?php 
                               if (auth()->getRole() == 'student') :
                            ?>
                            <a href="<?php echo url(auth()->getRole() . '/reports'); ?>" class="nav__link">
                                <i class='bx bx-edit nav__icon' ></i>
                                <span class="nav__name">Reports</span>
                            </a>
                            <a href="<?php echo url(auth()->getRole() . '/notifications'); ?>" class="nav__link">
                                <i class='bx bx-bell nav__icon' ></i>
                                <span class="nav__name">Notifications</span>
                            </a>
                            <?php
                             endif;
                            ?>
                            <?php 
                               if (auth()->getRole() == 'staff') :
                            ?>
                            <a href="<?php echo url(auth()->getRole() . '/notifications'); ?>" class="nav__link">
                                <i class='bx bx-bell nav__icon' ></i>
                                <span class="nav__name">Notifications</span>
                            </a>
                            <?php
                             endif;
                            ?>
                            <a href="<?php echo url(auth()->getRole() . '/profile'); ?>" class="nav__link">
                                <i class='bx bx-user nav__icon' ></i>
                                <span class="nav__name">Profile</span>
                            </a>
                            
                        </div>
    
                       
                    </div>
                </div>

                <a href="<?php echo url('logout'); ?>" class="nav__link nav__logout">
                    <i class='bx bx-log-out nav__icon' ></i>
                    <span class="nav__name">Log Out</span>
                </a>
            </nav>
        </div>