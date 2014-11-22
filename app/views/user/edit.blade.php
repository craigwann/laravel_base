@extends('layouts.darkForm')

@section('breadcrumbs')
    {{ Breadcrumbs::render('user', $user) }}
@stop

@section('content')
        <section id="contact" class="parallax-bg light-typo padding-top-bottom " data-parallax-background="/images/contact-bg.jpg" data-stellar-background-ratio=".1">

            <h1 class="section-title">Edit User</h1>

            <div class="row">

               {{ BootForm::open()->put()->attribute('class', 'col-sm-8 col-sm-offset-2')->action('/users/' . $user->id . '/') }}
                    {{ Bootform::bind($user) }}
                    @include('user.form')

                    <p class="text-center">
                        <button name="submit" type="submit" class="btn btn-quattro" data-error-message="Error!" data-sending-message="Sending..." data-ok-message="Message Sent">
                            <i class="fa fa-user"></i>
                            Save User
                        </button>
                    </p>
                {{ BootForm::close() }}

            </div>

        </section>
@stop