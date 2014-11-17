<!DOCTYPE html>
<html lang="en-US" class="no-js">

@include('elements.head')

<body data-spy="scroll" data-target="#main-nav" data-offset="400">

@include('elements.menu')

@yield('content');

@include('elements.footer')

</body>

</html>