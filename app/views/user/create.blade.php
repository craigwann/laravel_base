@extends('layouts.darkForm')

@section('content')
        <section id="contact" class="parallax-bg light-typo padding-top-bottom " data-parallax-background="/images/contact-bg.jpg" data-stellar-background-ratio=".1">

            <div class="container">

                <h1 class="section-title">Create User</h1>

                <div class="row">

                   {{ BootForm::open()->attribute('class', 'col-sm-8 col-sm-offset-2')->action('/users')}}
                    @include('user.form')

                        <p class="text-center">
                            <button name="submit" type="submit" class="btn btn-quattro" data-error-message="Error!" data-sending-message="Sending..." data-ok-message="Message Sent">
                                <i class="fa fa-user"></i>
                                Create User
                            </button>
                        </p>
                    {{ BootForm::close() }}

                </div>

            </div>

        </section>
@stop