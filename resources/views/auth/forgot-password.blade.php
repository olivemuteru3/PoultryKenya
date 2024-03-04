<x-guest-layout>
    <x-authentication-card>

        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <div class="mb-4 text-sm text-gray-600">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <x-validation-errors class="mb-4" />

        <form method="POST" action="{{ route('password.email') }}">
            @csrf

            <div class="block">
                <x-label for="email" value="{{ __('Email') }}" />
                <x-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
            </div>

            <div class="flex items-center justify-end mt-4">

                <x-button class="ms-4" onclick="startSpinner()">
                    <span id="buttonText">{{ __('Email Password Reset Link') }}</span>
                    <i id="spinnerIcon" class="fa fa-spinner fa-spin" style="display: none;"></i>
                </x-button>
                
                <script>
                    function startSpinner() {
                        document.getElementById("buttonText").style.display = "none"; // Hide the button text
                        document.getElementById("spinnerIcon").style.display = "inline-block"; // Show the spinner icon
                    }
                </script>
            
            </div>
        </form>
    </x-authentication-card>
</x-guest-layout>
