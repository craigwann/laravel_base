@extends('layouts.darkForm')

@section('content')
        <section id="contact" class="parallax-bg light-typo padding-top-bottom " data-parallax-background="/images/contact-bg.jpg" data-stellar-background-ratio=".1">

            <h1 class="section-title">Login</h1>

            <div class="row">

               {{ BootForm::open()->attribute('class', 'col-sm-4 col-sm-offset-4')->action('/login') }}
                    {{ BootForm::text('Username', 'username')->placeholder('Email or Username') }}
                    {{ BootForm::password('Password', 'password')->placeholder('Password') }}

                    <p class="text-center">
                        <button name="submit" type="submit" class="btn btn-quattro" data-error-message="Error!" data-sending-message="Sending..." data-ok-message="Message Sent">
                            Login
                        </button>
                    </p>
                {{ BootForm::close() }}

            </div>

        </section>
@stop