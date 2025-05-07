@extends('auth.layouts.contact')
@section('content')

  <!-- Session Status -->
  <x-auth-session-status class="mb-4" :status="session('status')" />
<div class="signin-logo tx-center tx-24 tx-bold tx-inverse">
    <a href="{{ route('login') }}"> <span class="tx-info tx-normal">Sign In</span></a>
</div>
<div class="tx-center mg-b-60"></div>

<form method="POST" action="{{ route('login') }}">
    @csrf

    <!-- Phone -->
    <div class="form-group">
        <x-input-label for="phone" :value="__('Phone')" />
        <x-text-input id="phone" class="form-control" type="text" name="phone" :value="old('phone')" required autofocus autocomplete="username" />
        <x-input-error :messages="$errors->get('phone')" class="mt-2" />
    </div>

    <!-- Password -->
    <div class="form-group">
        <x-input-label for="password" :value="__('Password')" />

        <x-text-input id="password" class="form-control"
                        type="password"
                        name="password"
                        required autocomplete="current-password" />

        <x-input-error :messages="$errors->get('password')" class="mt-2" />
    </div>

    <!-- Remember Me -->
    <div class="form-group">
        <label for="remember_me" class="inline-flex items-center">
            <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
            <span class="ml-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
        </label>
    </div>

    <div class="flex items-center justify-end mt-4">
        @if (Route::has('password.request'))
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('password.request') }}">
                {{ __('Forgot your password?') }}
            </a>
        @endif

        <x-primary-button class="ml-3" style="cursor:pointer">
            {{ __('Log in') }}
        </x-primary-button>
    </div>
    <div class="flex items-center justify-end mt-4">
    Do not have an account?
    <a href="{{route('register')}}"> Register Now</a>
</div>
</form>

@endsection