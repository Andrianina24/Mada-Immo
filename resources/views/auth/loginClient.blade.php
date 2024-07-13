@extends('layouts.form')

@section('title')
    Login
@endsection

@section('content')
<x-guest-layout>
    <x-auth-card>
        <x-slot name="logo">
            <a href="/">
                <!-- <x-application-logo class="w-20 h-20 fill-current text-gray-500" /> -->
            </a>
        </x-slot>

        <!-- Session Status -->
        <x-auth-session-status class="mb-4" :status="session('status')" />

        <!-- Validation Errors -->
        <x-auth-validation-errors class="mb-4" :errors="$errors" />
        <div div class="form-container">
        <form id="form-validation" method="POST" action="{{ route('login.client') }}">
            @csrf

            <!-- Email Address -->
            <div>
                <h3>Connexion locataire</h3>
                <x-label for="email" :value="__('Email')" />

                <x-input id="email" class="block mt-1 w-full" type="text" name="email" :value="old('email')" required autofocus />
            </div>

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
        
        <form id="form-validation" method="POST" action="{{ route('login.proprietaire') }}">
            @csrf

            <!-- Email Address -->
            <div>
            <h3>Connexion proprietaire</h3>
                <x-label for="email" :value="__('Numero')" />

                <x-input id="email" class="block mt-1 w-full" type="number" name="numero" :value="old('email')" required autofocus />
            </div>

                <x-button class="ml-3">
                    {{ __('Log in') }}
                </x-button>
            </div>
        </form>
        </div>
    </x-auth-card>
</x-guest-layout>
@endsection