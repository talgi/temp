<!-- START @LOADING ANIMATION -->
<div id="loading">
    <div class="loading-inner">
        <img class="animated bounceIn" src="<?=url()."/public/"?>img/loader/flat/3.gif" alt="..."/>
    </div>
</div>
<!--/ END LOADING ANIMATION -->

<!-- START @WRAPPER-->
<div id="wrapper">
    <!-- START @SIGN WRAPPER -->
    <div class="sign-wrapper">
        <?php //var_dump($errors->all()) ?>
        <?php if (count($errors->all()) > 0): ?>
            <div class="alert alert-info">
                <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
                <?php foreach ($errors->all() as $key => $value) {
                     echo $value;
                } ?>
            </div>
        <?php endif ?>
        
        
        <!-- Brand -->
        <div class="brand animated fadeInDown">
            <img src="<?=url("public/uploads/".Cache::get("site_settings")['site_logo'])?>" alt="brand logo"/>
        </div>
        <!--/ Brand -->

        <!-- Login form -->
        <form id="sign-in" class="form-horizontal animated zoomIn shadow rounded" method="post">
            <div class="sign-header">
                <div class="form-group">
                    <div class="sign-text">
                        <span>Admin Area</span>
                    </div>
                </div><!-- /.form-group -->
            </div><!-- /.sign-header -->
            <div class="sign-body">
                <div class="form-group">
                    <div class="input-group input-group-lg rounded">
                        <input type="text" class="form-control input-sm" placeholder="Email " name="email">
                        <span class="input-group-addon"><i class="fa fa-user"></i></span>
                    </div>
                </div><!-- /.form-group -->
                <div class="form-group">
                    <div class="input-group input-group-lg rounded">
                        <input type="password" class="form-control input-sm" placeholder="Password" name="password">
                        <span class="input-group-addon"><i class="fa fa-lock"></i></span>
                    </div>
                </div><!-- /.form-group -->
            </div><!-- /.sign-body -->
            <div class="sign-footer">
                
                <div class="form-group">
                    <button type="submit" class="btn btn-theme btn-lg btn-block no-margin rounded" id="login-btn">Sign In</button>
                </div><!-- /.form-group -->
                <div class="form-group">
                    <div class="row">
                        <div class="col-xs-12 text-mid">
                            <a href="page-lost-password.html" title="lost password">Lost password?</a>
                        </div>
                    </div>
                </div><!-- /.form-group -->
            </div><!-- /.sign-footer -->
        </form><!-- /.form-horizontal -->
        <!--/ Login form -->

        <!-- Content text -->
        <br/>
        <p class="text-muted text-center animated fadeinup">Need an account? <a href="<?=url()."/".CMS_NAME?>/register"> Sign up </a></p>
        <!--/ Content text -->

    </div><!-- /#sign-wrapper -->
    <!--/ END SIGN WRAPPER -->
</div><!-- /#wrapper -->
<!--/ END WRAPPER-->