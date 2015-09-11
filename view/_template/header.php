<!DOCTYPE html>
<html>
    <head>
        <meta charset="UTF-8">
        <title><?php echo $pageTitle; ?> - <?php echo websiteName; ?></title>
        <link href="<?php echo baseUrl; ?>css/baseStyle.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo baseUrl; ?>css/adminStyle.css" type="text/css" rel="stylesheet" />
        <script src="<?php echo baseUrl; ?>js/styler.js" type="text/javascript"></script>
        <script src="<?php echo baseUrl; ?>js/scriptCommon.js?<?php echo date('H:i:s') ?>" type="text/javascript"></script>
        <?php if ($pageTitle == 'NavBar') { ?>
            <script src="<?php echo baseUrl; ?>js/navBar.js?<?php echo date('H:i:s') ?>" type="text/javascript"></script>
        <?php } ?>
        <?php if ($pageTitle == 'Pages') { ?>
            <script src="<?php echo baseUrl; ?>js/pages.js?<?php echo date('H:i:s') ?>" type="text/javascript"></script>
        <?php } ?>
        <?php if ($pageTitle == 'Images' || $pageTitle == 'Slider') { ?>
            <script src="<?php echo baseUrl; ?>js/slider.js?<?php echo date('H:i:s') ?>" type="text/javascript"></script>
            <script src="<?php echo baseUrl; ?>js/images.js?<?php echo date('H:i:s') ?>" type="text/javascript"></script>
            <script src="<?php echo baseUrl; ?>js/jquery.Jcrop.min.js" type="text/javascript"></script>
        <?php } ?>
        <script src="<?php echo baseUrl; ?>js/ajaxCommon.js?<?php echo date('H:i:s') ?>" type="text/javascript"></script>
        <link rel="icon" type="image/png" href="<?php echo baseUrl ?>images/favicon.png">
    </head>
    <body <?php
    if ($pageTitle == 'NavBar') {
        $url = baseUrl . 'apanel/navBarData';
    } elseif ($pageTitle == 'Pages') {
        $url = baseUrl . 'apanel/loadPages';
    } elseif ($pageTitle == 'Slider') {
        $url = baseUrl . 'apanel/loadSlider';
    }
    ?>>
            <?php if ($pageTitle != 'Login') { ?>
            <nav class="navbar navbar-default" id="navigation" role="navigation">
                <div class="container-fluid">
                    <div class="navbar-header">
                        <a class="navbar-brand" href="<?php echo baseUrl; ?>apanel/home">
                            <?php echo websiteName; ?> - A Panel 1.0
                        </a>
                    </div>
                    <div class="collapse navbar-collapse" id="bs-example-navbar-collapse-1">
                        <ul class="nav navbar-nav" id="ulMenu">
                            <li><a href="<?php echo baseUrl; ?>apanel/home">Home</a></li>
                            <li><a href="<?php echo baseUrl; ?>apanel/menu">Menu</a></li>
                            <li><a href="<?php echo baseUrl; ?>apanel/pages">Pages</a></li>
                            <li><a href="<?php echo baseUrl; ?>apanel/images">Images</a></li>
                        </ul>
                        <span class="nav_user_info">Hello,
                            <?php
                            if ($gender == 'male' || $gender == 'Male') {
                                echo 'Mr. ';
                            } else {
                                echo 'Ms. ';
                            }
                            ?>
                            <a href="javascript:void(0);" id="name_link">
                                <?php echo ucfirst($name); ?>
                            </a>
                        </span>
                    </div>
                </div>
            </nav>
            <div class="logout_box" id="logout_box">
                <div class="arrow-up"></div>
                <div class="logout_text">
                    <div class="logout_btns">
                        <i class="glyphicon glyphicon-cog back_btn"></i>
                        <a href="<?php echo baseUrl; ?>apanel/settings" style="outline: 0px;">
                            Settings
                        </a>
                    </div>
                    <div class="logout_btns">
                        <i class="glyphicon glyphicon-off back_btn"></i>
                        <a href="<?php echo baseUrl; ?>apanel/logout">
                            Logout
                        </a>
                    </div>
                </div>
            </div>  
            <?php if (!empty($url)) { ?>
                <div id="flashBox"></div>
                <div id="bodyMain" url="<?php echo $url; ?>"></div>
                <script>
                    $(document).ready(function () {
                        $(window).load(function () {
                            loadData();
                        });
                    });
                </script>
            <?php } ?>
            <script>
                $(document).ready(function () {
                    $('#name_link').click(function () {
                        show_logout();
                    });
                    $('#name_link').focusout(function () {
                        hide_logout();
                    });
                });
            </script>
            <?php
        }