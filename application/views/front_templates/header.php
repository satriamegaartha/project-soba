<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="description" content="">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <!-- The above 4 meta tags *must* come first in the head; any other head content must come *after* these tags -->

    <!-- Title  -->
    <title>Home</title>

    <!-- Favicon  -->
    <link rel="icon" href="<?= base_url('assets_front/'); ?>img/core-img/favicon.ico">

    <!-- Core Style CSS -->
    <link rel="stylesheet" href="<?= base_url('assets_front/'); ?>css/core-style4.css">
    <link rel="stylesheet" href="<?= base_url('assets_front/'); ?>style.css">

    <!-- Responsive CSS -->
    <link href="<?= base_url('assets_front/'); ?>css/responsive3.css" rel="stylesheet">

</head>

<body>

    <div id="wrapper">

        <!-- ****** Header Area Start ****** -->
        <header class="header_area">
            <!-- Top Header Area Start -->
            <div class="top_header_area">
                <div class="container h-100">
                    <div class="row h-100 align-items-center">

                        <div class="col-4">
                            <div class="top_single_area d-flex align-items-center">
                                <!-- Logo Area -->
                                <div class="top_logo">
                                    <a href="<?= base_url('front') ?>"><img src="<?= base_url('assets_front/'); ?>img/core-img/logoxx.png" alt=""></a>
                                </div>

                            </div>
                        </div>
                        <div class="col-4">
                            <div class="container">
                                <div class="row justify-content-center">
                                    <div class="top_single_area d-flex align-items-center">
                                        <!-- Menu Area -->
                                        <div class="main-menu-area">
                                            <nav class="navbar navbar-expand-lg align-items-start">

                                                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#karl-navbar" aria-controls="karl-navbar" aria-expanded="false" aria-label="Toggle navigation"><span class="navbar-toggler-icon"><i class="ti-menu"></i></span></button>

                                                <div class="collapse navbar-collapse align-items-start collapse" id="karl-navbar">
                                                    <ul class="navbar-nav animated" id="nav">
                                                        <li class="nav-item"><a class="nav-link" href="<?= base_url('front') ?>">Home</a></li>
                                                        <li class="nav-item"><a class="nav-link" href="<?= base_url('front/vendorcard') ?>">Vendor</a></li>
                                                        <li class="nav-item"><a class="nav-link" href="<?= base_url('front/subscribemanagement') ?>">Subscription</a></li>
                                                    </ul>
                                                </div>
                                            </nav>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="col-4">
                            <div class="container">
                                <div class="row justify-content-end">
                                    <div class="top_single_area d-flex align-items-center">
                                        <?php if ($user) { ?>
                                            <div class="help-line">
                                                <a href="<?= base_url('auth/logout') ?>">Logout</a>
                                            </div>
                                        <?php } else { ?>
                                            <div class="help-line">
                                                <a href="<?= base_url('auth') ?>">Login</a>
                                            </div>
                                        <?php } ?>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>
        </header>
        <!-- ****** Header Area End ****** -->

        <!-- ****** Top Discount Area Start ****** -->
        <section class="top-discount-area d-md-flex align-items-center">
            <?php if ($event_top) { ?>
                <!-- Single Discount Area -->
                <div class="single-discount-area" style="cursor: pointer;" onclick="window.location='<?= base_url('front/detailevent/') . $event_top[0]['id'] ?>'">
                    <h5><?= $event_top[0]['name'] ?></h5>
                    <h5><?= "by " . $event_top[0]['user_name'] ?></h5>
                    <h6><?= "on " . date("d F Y", strtotime($event_top[0]['date_start'])) . " - " . date("d F Y", strtotime($event_top[0]['date_end'])) ?></h6>
                </div>
                <!-- Single Discount Area -->
                <div class="single-discount-area" style="cursor: pointer;" onclick="window.location='<?= base_url('front/detailevent/') . $event_top[1]['id'] ?>'">
                    <h5><?= $event_top[1]['name'] ?></h5>
                    <h5><?= "by " . $event_top[1]['user_name'] ?></h5>
                    <h6><?= "on " . date("d F Y", strtotime($event_top[1]['date_start'])) . " - " . date("d F Y", strtotime($event_top[1]['date_end'])) ?></h6>
                </div>
                <!-- Single Discount Area -->
                <div class="single-discount-area" style="cursor: pointer;" onclick="window.location='<?= base_url('front/detailevent/') . $event_top[2]['id'] ?>'">
                    <h5><?= $event_top[2]['name'] ?></h5>
                    <h5><?= "by " . $event_top[2]['user_name'] ?></h5>
                    <h6><?= "on " . date("d F Y", strtotime($event_top[2]['date_start'])) . " - " . date("d F Y", strtotime($event_top[2]['date_end'])) ?></h6>
                </div>
            <?php } else { ?>
                <!-- Single Discount Area -->
                <div class="single-discount-area">
                    <h5> </h5>
                    <h5> </h5>
                    <h6> </h6>
                </div>
                <!-- Single Discount Area -->
                <div class="single-discount-area">
                    <h5> </h5>
                    <h5> </h5>
                    <h6> </h6>
                </div>
                <!-- Single Discount Area -->
                <div class="single-discount-area">
                    <h5> </h5>
                    <h5> </h5>
                    <h6> </h6>
                </div>
            <?php } ?>
        </section>
        <!-- ****** Top Discount Area End ****** -->