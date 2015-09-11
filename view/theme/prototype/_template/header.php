<!DOCTYPE html>
<html> 
    <head> 
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0"> 
        <title><?php echo $pageTitle; ?> - Trekking</title>
        <link href="<?php echo baseUrl . $themeRes ?>/css/mainStyle.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo baseUrl . $themeRes ?>/css/supportStyle.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo baseUrl . $themeRes ?>/css/slideShow.css" type="text/css" rel="stylesheet" />
        <link href="<?php echo baseUrl . $themeRes ?>/css/accordain.css" type="text/css" rel="stylesheet" />
        <script type="text/javascript" src="<?php echo baseUrl . $themeRes ?>/js/jquery-1.9.1.min.js"></script>
        <script type="text/javascript" src="<?php echo baseUrl . $themeRes ?>/js/mainStyler.js"></script>
        <script type="text/javascript" src="<?php echo baseUrl . $themeRes ?>/js/supportScript.js"></script>
        <script type="text/javascript" src="<?php echo baseUrl . $themeRes ?>/js/jssor.js"></script>
        <script type="text/javascript" src="<?php echo baseUrl . $themeRes ?>/js/jssor.slider.js"></script>
        <script type="text/javascript" src="<?php echo baseUrl . $themeRes ?>/js/slideShow.js"></script>
    </head> 
    <body>
        <nav class="navbar navbar-default">
            <div class="container-fluid">
                <div class="navbar-header">
                    <div class="logo"><img src="<?php echo baseUrl . $themeRes ?>/images/logo.jpg" width="150" height="50"></div>
                    <!--<a class="navbar-brand" href="#">Brand</a>-->
                </div>
                <div class="collapse navbar-collapse">
                    <ul class="nav navbar-nav" id="menuUl">
                        <li><a href="<?php echo baseUrl; ?>">HOME</a></li>
                        <li id="destination">
                            <a href="#">DESTINATIONS <i class="glyphicon glyphicon-triangle-bottom"></i></a>
                            <div class="menu_list" id="destinationList">
                                <div id="arrowUp"></div>
                                <div><a href="#">Nepal</a></div>
                                <div><a href="#">Nepal</a></div>
                                <div><a href="#">Nepal</a></div>
                            </div>
                        </li>
                        <li>
                            <a href="#">ABOUT US <i class="glyphicon glyphicon-triangle-bottom"></i></a>
                        </li>
                        <li><a href="#">TRAVEL INFO</a></li>
                        <li><a href="#">DAY TOURS</a></li>
                        <li><a href="#">REVIEWS</a></li>
                        <li><a href="#">GALLERY</a></li>
                        <li><a href="#">CONTACT US</a></li>
                    </ul>
                    <form class="navbar-form navbar-right" role="search" id="searchSiteForm">
                        <div class="form-group inner-addon right-addon">
                            <input type="text" class="form-control" placeholder="Search..." />
                            <i class="glyphicon glyphicon-search iconProp"></i>
                        </div>
                        <!--<button type="submit" class="btn btn-default searchIcon" ><img src="images/searchIcon.png" alt="searchIcon" height="20" width="20"></button>-->
                    </form>
                </div>
            </div>
        </nav>