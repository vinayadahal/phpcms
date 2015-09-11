



<div class="popupBackground" id="loading" style="background: rgba(200,200,200,.5);">
    <div class="loadingIcon">
        <img src="<?php echo baseUrl; ?>images/adminIcons/loaderSmall.gif" alt="loading" style="height:32px;width:32px" />
    </div>
</div>
<nav class="<?php
if ($pageTitle == 'AddContent' || $pageTitle == "EditUser") {
    echo 'footerNormal';
} else {
    echo 'navbar navbar-default navbar-fixed-bottom';
}
?>" style="z-index:0;background: #D9EDF7;border: 0px;border: 1px solid #BCE8F1;" id="footerAdmin">
    <div class="footer_center">
        &copy; Copyright 2015 <?php echo websiteName; ?>. All Rights Reserved. Privacy And Policy.
    </div>
</nav>
</body>
</html>
