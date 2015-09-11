<div class="popupBackground" id="popupBackground">
    <!--alert box-->
    <div class="panel panel-info popupWrap" id="alertPop">
        <div class="panel-heading" style="height: 37px;">
            <h4 class="panel-title" style="float:left">Alert !!!</h4>
            <span class="closeBtn" id="alertClose"></span>
        </div>
        <div class="popupBox">
            <p id="paragraph"></p>
            <button class="admin_add_btn" id="alertOk">
                <i class="glyphicon glyphicon-ok back_btn"></i> ok
            </button>
        </div>
    </div>

    <!--confirm box-->
    <div class="panel panel-info popupWrap" id="confirmPop">
        <div class="panel-heading" style="height: 37px;">
            <h4 class="panel-title" style="float:left">Confirm Action !</h4>
            <span class="closeBtn" id="confirmClose"></span>
        </div>
        <div class="popupBox">
            <p id="paragraph">Confirm deletion of this image?</p>
            <button class="admin_add_btn" id="confirmYes">
                <i class="glyphicon glyphicon-ok back_btn"></i> Yes
            </button>
            <button class="admin_edit_btn" id="confirmNo">
                <i class="glyphicon glyphicon-remove back_btn"></i> No
            </button>
            <span id="eventYes" url=""></span>
        </div>
    </div>
</div>