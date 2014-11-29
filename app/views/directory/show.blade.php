@extends('layouts.leftSidebar')

@section('breadcrumbs')
    {{ Breadcrumbs::render('directory') }}
@stop

@section('sidebar')
    @include('directory.sidebar')
@stop

@section('content')
    <h1>Getting Started</h1>
    <p>
        Lorem ipsum dolor sit amet, consectetur adipiscing elit. Donec consequat leo quis justo tincidunt ultrices sed vel lectus. Praesent imperdiet lacus rutrum elit faucibus ullamcorper. Vestibulum ultricies odio vel sapien dictum rutrum. Suspendisse non scelerisque justo. Morbi tincidunt facilisis odio ut consequat. Maecenas tempus, mauris quis posuere dictum, justo purus semper justo, id faucibus magna diam ut nisi. Aliquam suscipit massa nisi, a tincidunt velit rhoncus quis. Cras magna nulla, vulputate ut congue et, auctor vitae nisl. Fusce pulvinar scelerisque turpis ac ornare. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Sed dictum fermentum iaculis. Phasellus diam augue, varius at volutpat sit amet, rhoncus consequat massa. Integer mollis nec justo ut lobortis. Sed convallis dictum augue, ut convallis justo.
    </p>
    <p>
        Nulla ac interdum justo. Vivamus ac fermentum dolor, id ullamcorper tortor. Duis bibendum mattis nibh sed eleifend. Maecenas vel diam consequat, facilisis augue vitae, euismod elit. Nulla ut neque ex. Aenean efficitur massa sed massa iaculis consequat. Curabitur hendrerit ex nisi, non tincidunt orci feugiat id.
    </p>
    <p>
       Fusce nec finibus odio. Curabitur euismod pulvinar ornare. Morbi pulvinar vitae odio in rhoncus. Duis pulvinar augue nec scelerisque faucibus. Etiam varius ipsum sed felis pulvinar euismod. Aliquam placerat tempor sapien, non sagittis odio suscipit et. Maecenas vitae pulvinar magna. Pellentesque non cursus ex, ut fermentum massa. Morbi tortor urna, facilisis vel iaculis vitae, volutpat a enim. Nullam luctus a lorem quis vehicula. Proin posuere faucibus augue, ac suscipit ipsum ultrices et. Aliquam suscipit ultricies enim. Curabitur in arcu ligula.
    </p>

@stop

