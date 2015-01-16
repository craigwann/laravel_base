<head>

    <!-- ==============================================
    Title and Meta Tags
    =============================================== -->
    <meta charset="utf-8">
    <title>IronQuest</title>
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">

    <!-- ==============================================
    Favicons
    =============================================== -->
    <link rel="shortcut icon" href="/images/favicon.ico">
    <link rel="apple-touch-icon" href="/images/apple-touch-icon.png">
    <link rel="apple-touch-icon" sizes="72x72" href="/images/apple-touch-icon-72x72.png">
    <link rel="apple-touch-icon" sizes="114x114" href="/images/apple-touch-icon-114x114.png">

    <!-- ==============================================
    CSS
    =============================================== -->
    {{ Minify::stylesheetDir('/css/bootstrap/') }}
    {{ Minify::stylesheetDir('/css/font-awesome/') }}
    {{ Minify::stylesheetDir('/css/flexslider/') }}
    {{ Minify::stylesheetDir('/css/quatro/') }}
    {{ Minify::stylesheetDir('/css/base/') }}
    {{ Minify::stylesheetDir('/css/form/') }}

    <!-- ==============================================
    Fonts
    =============================================== -->
    <link href='http://fonts.googleapis.com/css?family=Roboto:100,300,100italic,400,300italic' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Raleway:400,100,200,300' rel='stylesheet' type='text/css'>
    <link href='http://fonts.googleapis.com/css?family=Slabo+27px|Slabo+13px' rel='stylesheet' type='text/css'>

    <!-- ==============================================
    JS
    =============================================== -->

    <!--[if lt IE 9]>
    {{ Minify::javascriptDir('/js/respond/') }}
    <![endif]-->

    {{ Minify::javascriptDir('/js/modernizr/') }}


</head>