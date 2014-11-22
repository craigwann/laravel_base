<!DOCTYPE html>
<html lang="en-US" class="no-js">

@include('elements.head')

<body data-spy="scroll" data-target="#main-nav" data-offset="400">

@include('elements.menu')

@yield('breadcrumbs')

<div class="container main">
    @if(Session::has('message'))
    <div @if(Session::has('context')) class="alert alert-{{ Session::get('context') }}" @else class="alert" @endif role="alert">
      {{ Session::get('message') }}
    </div>
    @endif

    @yield('content')
</div>

@include('elements.footer')

</body>

</html>