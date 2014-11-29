<!DOCTYPE html>
<html lang="en-US" class="no-js">

@include('elements.head')

<body data-spy="scroll" data-target="#main-nav" data-offset="400">

@include('elements.menu')

@yield('breadcrumbs')

<div class="container main">

    <div class="row">

        @if(Session::has('message'))
        <div @if(Session::has('context')) class="alert alert-{{ Session::get('context') }}" @else class="alert" @endif role="alert">
          {{ Session::get('message') }}
        </div>
        @endif

        <div class="col-md-4">
                <div class="bs-sidebar hidden-print affix" role="complementary">
                     @yield('sidebar')
                </div>
            </div>

            <div class="col-md-8" role="main">
                @yield('content')
            </div>
        </div>
    </div>

</div>

@include('elements.footer')

</body>

</html>