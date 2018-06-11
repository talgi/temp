<!-- START @HEADER -->
            <header id="header">

                <!-- Start header left -->
                <div class="header-left">
                    <!-- Start offcanvas left: This menu will take position at the top of template header (mobile only). Make sure that only #header have the `position: relative`, or it may cause unwanted behavior -->
                    <div class="navbar-minimize-mobile left">
                        <i class="fa fa-bars"></i>
                    </div>
                    <!--/ End offcanvas left -->

                    <!-- Start navbar header -->
                    <div class="navbar-header" style="background-color: #DCDCDC;">

                        <!-- Start brand -->
                        <a class="navbar-brand" href="<?= url(CMS_NAME) ?>" style="padding:5px;">
                            <img class="logo" src="<?=url("public/img/logo-flip.png")?>"/>
                        </a><!-- /.navbar-brand -->
                        <!--/ End brand -->

                    </div><!-- /.navbar-header -->
                    <!--/ End navbar header -->

                    <!-- Start offcanvas right: This menu will take position at the top of template header (mobile only). Make sure that only #header have the `position: relative`, or it may cause unwanted behavior -->
                    <div class="navbar-minimize-mobile right">
                        <i class="fa fa-cog"></i>
                    </div>
                    <!--/ End offcanvas right -->

                    <div class="clearfix"></div>
                </div><!-- /.header-left -->
                <!--/ End header left -->

                <!-- Start header right -->
                <div class="header-right">
                    <!-- Start navbar toolbar -->
                    <div class="navbar navbar-toolbar">

                        <!-- Start left navigation -->
                        <ul class="nav navbar-nav navbar-left">

                            <!-- Start sidebar shrink -->
                            <li class="navbar-minimize">
                                <a href="javascript:void(0);" title="Minimize sidebar">
                                    <i class="fa fa-bars"></i>
                                </a>
                            </li>
                            <!--/ End sidebar shrink -->

                            

                        </ul><!-- /.navbar-left -->
                        <!--/ End left navigation -->

                        <!-- Start right navigation -->
                        <ul class="nav navbar-nav navbar-right"><!-- /.nav navbar-nav navbar-right -->
                   
                        

                        <!-- Start notifications -->
                        <li class="dropdown navbar-notification">

                       <!--     <a href="#" class="dropdown-toggle" data-toggle="dropdown"><i class="fa fa-bell-o"></i><span class="rounded count label label-danger">6</span></a>

                            <!-- Start dropdown menu -->
                            <div class="dropdown-menu animated flipInX">
                                <div class="dropdown-header">
                                    <span class="title">Notifications <strong>(10)</strong></span>
                                    <span class="option text-right"><a href="#"><i class="fa fa-cog"></i> Setting</a></span>
                                </div>
                                <div class="dropdown-body niceScroll">

                                    <!-- Start notification list -->
                                    <div class="media-list small">

                                        <a href="#" class="media">
                                            <div class="media-object pull-left"><i class="fa fa-share-alt fg-info"></i></div>
                                            <div class="media-body">
                                                <span class="media-text"><strong>Dolanan Remi : </strong><strong>Chris Job,</strong><strong>Denny Puk</strong> and <strong>Joko Fernandes</strong> sent you <strong>5 free energy boosts and other request</strong></span>
                                                <!-- Start meta icon -->
                                                <span class="media-meta">3 minutes</span>
                                                <!--/ End meta icon -->
                                            </div><!-- /.media-body -->
                                        </a><!-- /.media -->

                                        <a href="#" class="media">
                                            <div class="media-object pull-left"><i class="fa fa-cogs fg-success"></i></div>
                                            <div class="media-body">
                                                <span class="media-text">Your sistem is updated</span>
                                                <!-- Start meta icon -->
                                                <span class="media-meta">5 minutes</span>
                                                <!--/ End meta icon -->
                                            </div><!-- /.media-body -->
                                        </a><!-- /.media -->

                                        <a href="#" class="media">
                                            <div class="media-object pull-left"><i class="fa fa-ban fg-danger"></i></div>
                                            <div class="media-body">
                                                <span class="media-text">3 Member is BANNED</span>
                                                <!-- Start meta icon -->
                                                <span class="media-meta">5 minutes</span>
                                                <!--/ End meta icon -->
                                            </div><!-- /.media-body -->
                                        </a><!-- /.media -->

                                        <a href="#" class="media">
                                            <div class="media-object pull-left"><img class="img-circle" src="<?=url()."/public/img/"?>avatar/50/10.png" alt=""/></div>
                                            <div class="media-body">
                                                <span class="media-text">daddy pushed to project Blankon version 1.0.0</span>
                                                <!-- Start meta icon -->
                                                <span class="media-meta">45 minutes</span>
                                                <!--/ End meta icon -->
                                            </div><!-- /.media-body -->
                                        </a><!-- /.media -->

                                        <a href="#" class="media">
                                            <div class="media-object pull-left"><i class="fa fa-user fg-info"></i></div>
                                            <div class="media-body">
                                                <span class="media-text">Change your user profile</span>
                                                <!-- Start meta icon -->
                                                <span class="media-meta">1 days</span>
                                                <!--/ End meta icon -->
                                            </div><!-- /.media-body -->
                                        </a><!-- /.media -->

                                        <a href="#" class="media">
                                            <div class="media-object pull-left"><i class="fa fa-book fg-info"></i></div>
                                            <div class="media-body">
                                                <span class="media-text">Added new article</span>
                                                <!-- Start meta icon -->
                                                <span class="media-meta">1 days</span>
                                                <!--/ End meta icon -->
                                            </div><!-- /.media-body -->
                                        </a><!-- /.media -->

                                        <!-- Start notification indicator -->
                                        <a href="#" class="media indicator inline">
                                            <span class="spinner">Load more notifications...</span>
                                        </a>
                                        <!--/ End notification indicator -->

                                    </div>
                                    <!--/ End notification list -->

                                </div>
                                <div class="dropdown-footer">
                                    <a href="#">See All</a>
                                </div>
                            </div>
                            <!--/ End dropdown menu -->

                        </li><!-- /.dropdown navbar-notification -->
                        <!--/ End notifications -->
                        
                         <li><a href="<?=url(CMS_NAME."/logout")?>"><i class="fa fa-sign-out"></i>Logout</a></li>
                        </ul><!-- /.navbar-right -->
                        <!--/ End right navigation -->

                    </div><!-- /.navbar-toolbar -->
                    <!--/ End navbar toolbar -->
                </div><!-- /.header-right -->
                <!--/ End header left -->

            </header> <!-- /#header -->
            <!--/ END HEADER -->