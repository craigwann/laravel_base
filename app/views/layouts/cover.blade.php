<!DOCTYPE html>
<html lang="en-US" class="no-js">

@include('elements.head')

<body data-spy="scroll" data-target="#main-nav" data-offset="400">

<header id="home" class="parallax-bg" data-parallax-background="/images/header-bg1.jpg" data-stellar-background-ratio=".3">

    <div class="header-content">

        <img class="header-logo" src="/images/logo.png" alt=""/>

        <div class="flexslider header-slider">

            <ul class="slides">

                <li><h1 class="bordered-text">A <span class="primary">Tabletop</span> RPG</h1></li>
                <li><h1 class="bordered-text">Where <span class="primary">Real Life</span></h1></li>
                <li><h1 class="bordered-text">Has <span class="primary">In Game</span> Effect</h1></li>

            </ul>

        </div><!--End home-slider -->

        <a class="scroll-button scrollto" href="#coming-soon"><i class="fa fa-angle-down"></i></a>

    </div>

</header>

<!--=== PAGE PRELOADER ===-->
<div id="page-loader"><span class="page-loader-gif">Loading...</span></div>

<div id="main-nav" class="navbar">
    <div class="container">

        <div class="navbar-header">

            <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#site-nav">
                <span class="icon-bar"></span><span class="icon-bar"></span><span class="icon-bar"></span>
            </button>

            <!-- ======= LOGO ========-->
            <a class="navbar-brand scrollto" href="#home">

                <img class="site-logo" src="/images/logo-small.png" alt="logo" />
            </a>

        </div>

        <div id="site-nav" class="navbar-collapse collapse">
            <ul class="nav navbar-nav navbar-right">
                <li class="sr-only">
                    <a href="#home" class="scrollto">Home</a>
                </li>
                <li>
                    <a href="/login" >Login</a>
                </li>
            </ul>
        </div><!--End navbar-collapse -->

    </div><!--End container -->

</div><!--End main-nav -->

<!-- ==============================================
CONTACT
=============================================== -->
<section id="contact" class="parallax-bg light-typo padding-top-bottom " data-parallax-background="/images/contact-bg.jpg" data-stellar-background-ratio=".1">

    <div class="container">

        <a name="coming-soon" class="scrollto"></a>

        <h1 class="section-title">Coming Soon!</h1>
        <p class="section-description">Join our mailing list for more information as soon as it's available!</p>

        <div class="row">

            <!--=== Contact Form ===-->

            <form id="contact-form" class="col-sm-8 col-sm-offset-2" action="contact.php" method="post" novalidate>

                <div class="form-group">
                    <label class="control-label" for="contact-name">Name</label>
                    <div class="controls">
                        <input id="contact-name" name="contactName" placeholder="Your name" class="form-control requiredField" type="text" data-error-empty="Please enter your name">
                    </div>
                </div><!-- End name input -->

                <div class="form-group">
                    <label class="control-label" for="contact-mail">Email</label>
                    <div class=" controls">
                        <input id="contact-mail" name="email" placeholder="Your email" class="form-control requiredField" type="email" data-error-empty="Please enter your email" data-error-invalid="Invalid email address">
                    </div>
                </div><!-- End email input -->

                <p class="text-center"><button name="submit" type="submit" class="btn btn-quattro" data-error-message="Error!" data-sending-message="Sending..." data-ok-message="Message Sent"><i class="fa fa-paper-plane"></i>Join List</button></p>
                <input type="hidden" name="submitted" id="submitted" value="true" />

            </form><!-- End contact-form -->

        </div>

    </div>

</section>

@include('elements.footer')

</body>

</html>