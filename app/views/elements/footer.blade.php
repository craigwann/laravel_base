<footer id="main-footer">

    <div class="container text-center">

        <!--<img class="img-responsive img-center footer-logo" src="/images/logo-black.png" alt="" />

        <ul class="social-links">
            <li><a href="#link"><i class="fa fa-twitter fa-fw"></i></a></li>
            <li><a href="#link"><i class="fa fa-facebook fa-fw"></i></a></li>
            <li><a href="#link"><i class="fa fa-google-plus fa-fw"></i></a></li>
            <li><a href="#link"><i class="fa fa-dribbble fa-fw"></i></a></li>
            <li><a href="#link"><i class="fa fa-linkedin fa-fw"></i></a></li>
        </ul>-->
        <hr />
        <p>&copy {{ date("Y") }}, IronQuest by Admonishing Ray.</p>

    </div>

</footer>

<!-- ==============================================
SCRIPTS
=============================================== -->
<script src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.2/jquery.min.js"></script>

{{ Minify::javascriptDir('/js/bootstrap/') }}
{{ Minify::javascriptDir('/js/jqueryPlugins/') }}
{{ Minify::javascriptDir('/js/plugins/') }}
{{ Minify::javascriptDir('/js/base/') }}
{{ Minify::javascriptDir('/js/quatro/') }}