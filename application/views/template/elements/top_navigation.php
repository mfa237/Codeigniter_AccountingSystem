<!--Header-->
<header id="topnav" class="navbar navbar-default navbar-fixed-top" role="banner">

    <div class="logo-area">
                <span id="trigger-sidebar" class="toolbar-trigger toolbar-icon-bg">
                    <a data-toggle="tooltips" data-placement="right" title="Toggle Sidebar">
                        <span class="icon-bg">
                            <i class="ti ti-menu"></i>
                        </span>
                    </a>
                </span>

        <a class="navbar-brand" href="#">JCORE</a>

        <div class="toolbar-icon-bg hidden-xs" id="toolbar-search">
            <div class="input-group">
                <span class="input-group-btn"><button class="btn" type="button"><i class="ti ti-search"></i></button></span>
                <input type="text" class="form-control general-search" placeholder="Search..." style="border: none!important;">
                <span class="input-group-btn"><button class="btn" type="button"><i class="ti ti-close"></i></button></span>
            </div>
        </div>

    </div><!-- logo-area -->

    <ul class="nav navbar-nav toolbar pull-right">

        <li class="toolbar-icon-bg visible-xs-block" id="trigger-toolbar-search">
            <a href="#"><span class="icon-bg"><i class="ti ti-search"></i></span></a>
        </li>

        <li class="toolbar-icon-bg hidden-xs">
            <a href="#"><span class="icon-bg"><i class="ti ti-world"></i></span></i></a>
        </li>

        <li class="toolbar-icon-bg hidden-xs">
            <a href="#"><span class="icon-bg"><i class="ti ti-view-grid"></i></span></i></a>
        </li>

        <li class="toolbar-icon-bg hidden-xs" id="trigger-fullscreen">
            <a href="#" class="toggle-fullscreen"><span class="icon-bg"><i class="ti ti-fullscreen"></i></span></i></a>
        </li>

        <!--<li class="dropdown toolbar-icon-bg hidden-xs">
            <a href="#" class="hasnotifications dropdown-toggle" data-toggle='dropdown'><span class="icon-bg"><i class="ti ti-email"></i></span><span
                    class="badge badge-deeporange">2</span></a>
            <div class="dropdown-menu notifications arrow">
                <div class="topnav-dropdown-header">
                    <span>Messages</span>
                </div>
                <div class="scroll-pane">
                    <ul class="media-list scroll-content">
                        <li class="media notification-message">
                            <a href="#">
                                <div class="media-left">
                                    <img class="img-circle avatar" src="<?php echo $this->session->user_photo; ?>" alt="" />
                                </div>
                                <div class="media-body">
                                    <h4 class="notification-heading"><strong>Will Whedon</strong> <span class="text-gray">‒ The movie of this ...</span></h4>
                                    <span class="notification-time">4 days ago</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="#">See all messages</a>
                </div>
            </div>
        </li>-->

        <!--<li class="dropdown toolbar-icon-bg">
            <a href="#" class="hasnotifications dropdown-toggle" data-toggle='dropdown'><span class="icon-bg"><i class="ti ti-bell"></i></span><span class="badge badge-deeporange">2</span></a>
            <div class="dropdown-menu notifications arrow">
                <div class="topnav-dropdown-header">
                    <span>Notifications</span>
                </div>
                <div class="scroll-pane">
                    <ul class="media-list scroll-content">

                        <li class="media notification-danger">
                            <a href="#">
                                <div class="media-left">
                                    <span class="notification-icon"><i class="ti ti-arrow-up"></i></span>
                                </div>
                                <div class="media-body">
                                    <h4 class="notification-heading">Initial Release 1.0</h4>
                                    <span class="notification-time">4 days ago</span>
                                </div>
                            </a>
                        </li>
                    </ul>
                </div>
                <div class="topnav-dropdown-footer">
                    <a href="#">See all notifications</a>
                </div>
            </div>
        </li>-->

        <li class="dropdown toolbar-icon-bg">
            <a href="#" class="dropdown-toggle username" data-toggle="dropdown">
                <img class="img-circle" src="<?php echo $this->session->user_photo; ?>" alt="" />
            </a>
            <ul class="dropdown-menu userinfo arrow">
                <li><a href="Profile"><i class="ti ti-user"></i><span>Profile</span></a></li>
                <!-- <li><a href="login/transaction/logout"><i class="ti ti-shift-right"></i><span>Sign Out</span></a></li> -->
                <li><a href="Login/transaction/logout"><i class="ti ti-shift-right"></i><span>Sign Out</span></a></li>
            </ul>
        </li>

    </ul>

</header><!--Header-->