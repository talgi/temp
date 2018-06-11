<aside id="sidebar-left" class="sidebar-circle">

    <div class="sidebar-content">
        <div class="media">
            <a class="pull-left has-notif avatar" title="To see your image click and set a gravatar" href="https://en.gravatar.com/">
                <?php 
                    $email = Auth::user()->email;
                    $default = url() . "/public/img/avatar/50/1.png";
                    $size = 40;
                    $grav_url = "http://www.gravatar.com/avatar/" . md5( strtolower( trim( $email ) ) ) . "?d=" . "&s=" . $size;

                ?>
                <img src="<?= $grav_url ?>" alt="admin">
            </a>
            <div class="media-body">
                <h4 class="media-heading">Hello, <span><?=Auth::user()->role?></span></h4>
                <small><?=Auth::user()->email?></small>
            </div>
        </div>
    </div>



    <ul class="sidebar-menu">

        <li <?=Request::segment(2) == '' ? "class='active'" : ""?>>
            <a href="<?=url()?>">
                <span class="icon"><i class="fa fa-home"></i></span>
                <span class="text">Home</span>
            </a>
        </li>
<!--
        <li class="submenu  <?=in_array(Request::segment(2),  array("analytics" , "user-settings" , "site-settings" , "seo")) ? "active" : ""?>">
            <a href="javascript:void(0);">
                <span class="icon"><i class="fa fa-cogs"></i></span>
                <span class="text">General Settings</span>
                <span class="plus"></span>
                <span class="selected"></span>
            </a>
            <ul>
                <li <?=Request::segment(2) == 'analytics' ? "class='active'" : ""?> ><a href="<?=url(CMS_NAME."/analytics")?>">Analytics</a></li>
                <li <?=Request::segment(2) == 'user-settings' ? "class='active'" : ""?> ><a href="<?=url(CMS_NAME."/user-settings")?>">User Settings</a></li>
                <li <?=Request::segment(2) == 'site-settings' ? "class='active'" : ""?> ><a href="<?=url(CMS_NAME."/site-settings")?>">Site Settings</a></li>
                <li <?=Request::segment(2) == 'seo' ? "class='active'" : ""?> ><a href="<?=url(CMS_NAME."/seo")?>">SEO</a></li>
            </ul>
        </li>
  -->

        <li <?=Request::segment(2) == 'mange-users' ? "class='active'" : ""?>>
            <a href="<?=url(CMS_NAME."/mange-users")?>">
                <span class="icon"><i class="fa fa-file-o"></i></span>
                <span class="text">Users</span>
            </a>
        </li>
        <li <?=Request::segment(2) == 'categories' ? "class='active'" : ""?>>
            <a href="<?=url(CMS_NAME."/categories")?>">
                <span class="icon"><i class="fa fa-file-o"></i></span>
                <span class="text">Add / Edit Category</span>
            </a>
        </li>

        <li class="submenu  <?=in_array(Request::segment(2),  array("home-prizes" , "movie")) ? "active" : ""?>">
            <a href="javascript:void(0);">
                <span class="icon"><i class="fa fa-cogs"></i></span>
                <span class="text">Home page</span>
                <span class="plus"></span>
                <!-- <span class="selected"></span> -->
            </a>
            <ul>
                <li <?=Request::segment(2) == 'home-prizes' ? "class='active'" : ""?> ><a href="<?=url(CMS_NAME."/home-prizes")?>">Home prizes</a></li>
                <li <?=Request::segment(2) == 'movie' ? "class='active'" : ""?> ><a href="<?=url(CMS_NAME."/movie")?>">Movie</a></li>

            </ul>
        </li>
        <li class="submenu  <?=in_array(Request::segment(3),  array("faq" , "about","privacy","terms","contact","how")) ? "active" : ""?>">
            <a href="javascript:void(0);">
                <span class="icon"><i class="fa fa-cogs"></i></span>
                <span class="text">Content pages</span>
                <span class="plus"></span>
                <!-- <span class="selected"></span> -->
            </a>
            <ul>
                <li <?=Request::segment(3) == 'faq' ? "class='active'" : ""?> ><a href="<?=url(CMS_NAME."/inner/faq")?>">FAQ's</a></li>
                <li <?=Request::segment(3) == 'about' ? "class='active'" : ""?> ><a href="<?=url(CMS_NAME."/inner/about")?>">About flipMadness</a></li>
                <li <?=Request::segment(3) == 'privacy' ? "class='active'" : ""?> ><a href="<?=url(CMS_NAME."/inner/privacy")?>">Privacy Policy</a></li>
                <li <?=Request::segment(3) == 'terms' ? "class='active'" : ""?> ><a href="<?=url(CMS_NAME."/inner/terms")?>">Terms & Conditions</a></li>
                <li <?=Request::segment(3) == 'how' ? "class='active'" : ""?> ><a href="<?=url(CMS_NAME."/inner/how")?>">How to play</a></li>

            </ul>
        </li>
        <li <?=Request::segment(2) == 'medals' ? "class='active'" : ""?>>
            <a href="<?=url(CMS_NAME."/medals")?>">
                <span class="icon"><i class="fa fa-file-o"></i></span>
                <span class="text">Medals</span>
            </a>
        </li>
        <li <?=Request::segment(2) == 'lotteries-cat' ? "class='active'" : ""?>>
            <a href="<?=url(CMS_NAME."/lotteries-cat")?>">
                <span class="icon"><i class="fa fa-file-o"></i></span>
                <span class="text">Lotteries</span>
            </a>
        </li>
        <li <?=Request::segment(2) == 'notifications' ? "class='active'" : ""?>>
            <a href="<?=url(CMS_NAME."/notifications")?>">
                <span class="icon"><i class="fa fa-file-o"></i></span>
                <span class="text">Create notifications</span>
            </a>
        </li>
        <li>
            <a href="<?=url(CMS_NAME."/winners")?>">
                <span class="icon"><i class="fa fa-file-o"></i></span>
                <span class="text">Download winners</span>
            </a>
        </li>
        <!--
        <li <?=Request::segment(2) == 'site-text' ? "class='active'" : ""?>>
            <a href="<?=url(CMS_NAME."/site-text")?>">
                <span class="icon"><i class="fa fa-file-o"></i></span>
                <span class="text">global site text</span>
            </a>
        </li>


        <li <?=Request::segment(2) == 'backup' ? "class='active'" : ""?>>
            <a href="<?=url(CMS_NAME."/backup")?>">
                <span class="icon"><i class="fa fa-cloud-upload"></i></span>
                <span class="text">Backup and Restore</span>
            </a>
        </li>
-->
    </ul>


 
    <div class="sidebar-footer hidden-xs hidden-sm hidden-md">
     
        <a id="fullscreen" class="pull-left" href="#" data-toggle="tooltip" data-placement="top" data-title="Fullscreen"><i class="fa fa-desktop"></i></a>
        <a class="pull-left" href="<?=url(CMS_NAME."/logout")?>" data-toggle="tooltip" data-placement="top" data-title="Logout"><i class="fa fa-power-off"></i></a>
    </div>
    

</aside>