<md-toolbar id="mainHeader">
    <div class="md-toolbar-tools">
        <div layout layout-align="space-between center" flex>
            <div><a href="/"><img src="/public/Images/ccm_logo.png" /></a></div>
            <?php if ($_SESSION['usr_id'] != '') { ?>
                <div layout layout-align="center center">
                    <md-button class="md-button md-accent md-hue-1" href="/leads">All Leads</md-button>
                    <md-button class="md-button md-accent md-hue-1" href="/users">Users</md-button>
                    <md-button class="md-button md-accent md-hue-1" href="/logout">Logout</md-button>
                </div> 
            <?php } ?>
        </div>
    </div>
</md-toolbar>