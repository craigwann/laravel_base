<!--=== PAGE PRELOADER ===-->
<div id="page-loader"><span class="page-loader-gif">Loading...</span></div>

<div id="main-nav" class="navbar">
    <div class="container">

        <div class="navbar-header">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#site-nav">
                <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>

            <!-- ======= LOGO ========-->
            <a class="navbar-brand" href="/">

                <img class="site-logo" src="/images/logo-small.png" alt="logo" />
            </a>

        </div>

        <div id="site-nav" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
            @if (Auth::guest())
                <li>
                    <a href="/login">Login</a>
                </li>
            @else
                <li>
                   <a href="{{ route('dashboard.show') }}"><i class="fa fa-user"></i> {{Auth::user()->username}}</a>
                </li>
                <li>
                    <a href="{{ route('users.logout') }}"><i class="fa fa-sign-out"></i> Logout</a>
                </li>
            @endif
            </ul>
        </div><!--End navbar-collapse -->

    </div><!--End container -->

</div><!--End main-nav -->