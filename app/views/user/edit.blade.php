@extends('layouts.darkForm')

@section('breadcrumbs')
    {{ Breadcrumbs::render('user', $user) }}
@stop

@section('content')
        <section class="parallax-bg light-typo padding-top-bottom " data-parallax-background="/images/contact-bg.jpg" data-stellar-background-ratio=".1">

            <div class="col-sm-8 col-sm-offset-2">
                <h1 class="section-title"><span class="title-gear bootbox-html" bootbox-target=".options" bootbox-title="User Options"><i class="fa fa-gear"></i></span>Edit User</h1>
                <div class="options hide">
                    <ul class="nav navmenu-nav">
                        @if($user->deleted_at)
                        <li>
                            <a class="bootbox-confirm" href="{{ action('UserController@revive', array($user->id)) }}"><i class="fa fa-life-ring"></i> Revive</a>
                        </li>
                        @else
                        <li>
                            <a class="bootbox-confirm" href="{{ action('UserController@destroy', array($user->id)) }}"><i class="fa fa-remove"></i> Destroy</a>
                        </li>
                        @endif
                    </ul>
                </div>

                @if($user->deleted_at)
                <div class="alert alert-danger" role="alert">
                  <i class="fa fa-exclamation"></i>
                  This user is inactive.
                </div>
                @endif
            </div>

            <div class="row">

               {{ BootForm::open()->put()->attribute('class', 'col-sm-8 col-sm-offset-2')->action('/users/' . $user->id . '/') }}
                    {{ Bootform::bind($user) }}
                    @include('user.form')

                    <p class="text-center">
                        <button name="submit" type="submit" class="btn btn-quattro" data-error-message="Error!" data-sending-message="Sending..." data-ok-message="Message Sent">

                            Save User
                        </button>
                    </p>
                {{ BootForm::close() }}

            </div>


        </section>

        @if ((Auth::checkAccess(Config::get('auth.userType.admin'))))

            <section class="gray-bg padding-top-bottom">
                <h2 class="section-title">API Key</h2>

                <div class="row">

                   {{ BootForm::open()->attribute('class', 'col-sm-8 col-sm-offset-2')->action('users/' . $user->id . '/apikey') }}
                        @if (!empty($apiKey->id))
                            {{ Bootform::bind($apiKey) }}
                            <h3>Key: {{ $apiKey->key }}</h3>
                        @endif

                        {{ BootForm::select('Level', 'level')->options($apiKeyOptions) }}
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