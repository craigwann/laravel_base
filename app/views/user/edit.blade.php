@extends('layouts.darkForm')

@section('breadcrumbs')
    {{ Breadcrumbs::render('user', $user) }}
@stop

@section('content')
        <section class="parallax-bg light-typo padding-top-bottom " data-parallax-background="/images/contact-bg.jpg" data-stellar-background-ratio=".1">

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

        @if (Auth::checkAccess(Config::get('auth.userType.admin')))
            <section class="gray-bg padding-top-bottom">
                <h2 class="section-title">API Key</h1>

                <div class="row">

                   {{ BootForm::open()->attribute('class', 'col-sm-8 col-sm-offset-2')->action('users/' . $user->id . '/apikey') }}
                        @if (!empty($apiKey->id))
                            {{ Bootform::bind($apiKey) }}
                            <h3>Key: {{ $apiKey->key }}</h3>
                        @endif

                        {{ BootForm::select('Level', 'level')->options(['' => 'Choose Level...', 1 => 1, 2 => 2, 3 => 3, 4 => 4, 5 => 5, 6 => 6, 7 => 7, 8 => 8, 9 => 9, 10 => 10]) }}
                        {{ BootForm::select('Ignore Limits', 'ignore_limits')->options(['' => 'Ignore Limits?', true => 'Yes', false => 'No']) }}

                        <p class="text-center">
                            <button name="submit" type="submit" class="btn btn-quattro" data-error-message="Error!" data-sending-message="Sending..." data-ok-message="Message Sent">
                                <i class="fa fa-key"></i>
                                @if(!empty($apiKey->id))
                                    Save Key
                                @else
                                    Generate Key
                                @endif
                            </button>
                        </p>
                    {{ BootForm::close() }}

                </div>
            </section>
        @endif
@stop