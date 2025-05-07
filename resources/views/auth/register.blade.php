@extends('auth.layouts.contact')
@section('content')

<div class="signin-logo tx-center tx-24 tx-bold tx-inverse">
   <a href="{{ route('register') }}"> <span class="tx-info tx-normal">Sign Up</span></a>
</div>
<div class="tx-center mg-b-20"></div>

 <form method="POST" action="{{ route('register') }}">
        @csrf

        <!-- Name -->
        <div class="form-group">
            <x-input-label for="name" :value="__('Name')" />
            <x-text-input id="name" class="form-control"  type="text" name="name" :value="old('name')" required autofocus autocomplete="name" />
            <x-input-error :messages="$errors->get('name')" class="mt-2" />
        </div>

         <!-- Email Address -->
        <div class="form-group">
            <x-input-label for="email" :value="__('Email (optinal)')" />
            <x-text-input id="email" class="form-control" type="email" name="email" :value="old('email')" autocomplete="username" />
            <x-input-error :messages="$errors->get('email')" class="mt-2" />
        </div>

        <!-- Phone -->
        <div class="form-group">
            <x-input-label for="phone" :value="__('Phone')" />
            <x-text-input id="phone" class="form-control"  type="number" name="phone" :value="old('phone')" required autocomplete="phone"/>
            <x-input-error :messages="$errors->get('phone')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="form-group">
            <x-input-label for="password" :value="__('Password')" />

            <x-text-input id="password" class="form-control" 
                            type="password"
                            name="password"
                            required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="form-group">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="form-control" 
                            type="password"
                            name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500" href="{{ route('login') }}">
                {{ __('Already registered? Login ') }}
            </a>

            <x-primary-button class="ml-4" style="cursor:pointer">
                {{ __('Register') }}
            </x-primary-button>
        </div>
    </form>

@endsection
