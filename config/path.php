<?php

// Define your routes in this page.
$path['home'] = 'userHome/main';

$path['apanel/login'] = 'adminHomeController/login';
$path['apanel/loginCheck'] = 'adminHomeController/loginCheck';
$path['apanel/logout'] = 'adminHomeController/logout';

$path['apanel'] = 'adminHomeController/main';
$path['apanel/'] = 'adminHomeController/main';
$path['apanel/home'] = 'adminHomeController/main';


$path['apanel/menu'] = 'menuController/main';
$path['apanel/menu/navBar'] = 'menuController/navBar';
$path['apanel/addNav'] = 'menuController/addNav';
$path['apanel/insertNav'] = 'menuController/insertNav';
$path['apanel/editNav'] = 'menuController/editNav';
$path['apanel/updateNav'] = 'menuController/updateNav';
$path['apanel/deleteNav'] = 'menuController/deleteNav';
$path['apanel/navBarData'] = 'menuController/navBarDataTable';

$path['apanel/pages'] = 'pageController/main';
$path['apanel/loadPages'] = 'pageController/loadTableData';
$path['apanel/addPage'] = 'pageController/addPage';
$path['apanel/insertPage'] = 'pageController/insertPage';
$path['apanel/editPage'] = 'pageController/editPage';
$path['apanel/updatePage'] = 'pageController/updatePage';
$path['apanel/deletePage'] = 'pageController/deletePage';

$path['apanel/images'] = 'imageController/main';
$path['apanel/images/slider'] = 'sliderController/slider';
$path['apanel/loadSlider'] = 'sliderController/loadSlider';
$path['apanel/images/addSlider'] = 'sliderController/addSlider';
$path['apanel/insertSlider'] = 'sliderController/insertSlider';
$path['apanel/images/editSlider'] = 'sliderController/editSlider';
$path['apanel/images/updateSlider'] = 'sliderController/updateSlider';
$path['apanel/images/deleteSlider'] = 'sliderController/deleteSlider';

$path['apanel/settings'] = 'settingController/main';
$path['apanel/settings/theme'] = 'settingController/theme';
$path['apanel/settings/themeSet'] = 'settingController/themeSet';
