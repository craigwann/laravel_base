@extends('layouts.default')

@section('content')
        <section id="contact" class="parallax-bg light-typo padding-top-bottom " data-parallax-background="/images/contact-bg.jpg" data-stellar-background-ratio=".1">

            <div class="container">

                <h1 class="section-title">Create User</h1>

                <div class="row">

                   {{ BootForm::open()->attribute('class', 'col-sm-8 col-sm-offset-2')->action('/user')}}
                        {{ BootForm::text('First Name', 'user_first_name')->placeholder('First Name') }}
                        {{ BootForm::text('Last Name', 'user_last_name')->placeholder('Last Name') }}
                        {{ BootForm::email('Email', 'email')->placeholder('Email') }}
                        {{ BootForm::text('Username', 'user_username')->placeholder('Username') }}
                        {{ BootForm::select('Type', 'user_type_id')->options(array_merge(['' =>  'Choose User Type...'], $user_type_options))->select('') }}
                        {{ BootForm::password('Password', 'password')->placeholder('Password') }}
                        {{ BootForm::password('Confirm Password', 'password_confirmation')->placeholder('Confirm Password') }}
                        {{ BootForm::select('Active', 'user_active')->options(['' => 'Choose Status', true => 'Active', false => 'Inactive'])->select(true) }}

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