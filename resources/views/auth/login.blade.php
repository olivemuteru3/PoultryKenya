<x-guest-layout>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <style>
        /* Style for the form background image */
        .form-background {
            background-image: url('https://img.freepik.com/free-photo/hens-factory-chicken-cages_335224-1408.jpg'); /* Replace with your image URL */
            background-size: cover;
            background-position: center;
            height: 100vh; /* Adjust height as needed */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            z-index: -1;
        }

        /* Center and style the label */
        .login-label-container {
            text-align: center;
            margin-bottom: 20px; /* Adjust margin as needed */
        }

        .login-label {
            font-size: 24px; /* Adjust font size as needed */
            color: #0a0707; /* Text color */
        }

         /* Style for the auth links */
    .auth-links {
        margin-top: 20px; /* Adjust margin as needed */
        text-align: center; /* Center align the links */
    }

    .auth-link {
        display: inline-block;
        margin: 0 10px; /* Adjust margin between links as needed */
        font-size: 14px; /* Adjust font size as needed */
        color: #3182ce; /* Link color */
        transition: color 0.3s ease-in-out; /* Smooth transition */
    }

    .auth-link:hover {
        color: #2c5282; /* Hover color */
    }
    </style>

    <div class="form-background"></div>

    </style>
    <x-authentication-card>
        <x-slot name="logo">
            <x-authentication-card-logo />
        </x-slot>

        <x-validation-errors class="mb-4" />

        @if (session('status'))
            <div class="mb-4 font-medium text-sm text-green-600">
                {{ session('status') }}
            </div>
        @endif

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="login-label-container">
                <label class="login-label">Poultry System Login</label>
            </div>

            <div>
                <x-label for="loginname" value="{{ __('Email/Phone') }}" />
                <x-input id="loginname" class="block mt-1 w-full" type="text" name="loginname" :value="old('loginname')" />
            </div>

            <div class="mt-4">
                <x-label for="password" value="{{ __('Password') }}" />
                <x-input id="password" class="block mt-1 w-full" type="password" name="password" required autocomplete="current-password" />
            </div>

            <div class="block mt-4">
                <label for="remember_me" class="flex items-center">
                    <x-checkbox id="remember_me" name="remember" />
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                <a class="auth-link" href="{{ route('password.request') }}">
                    {{ __('Forgot your password?') }}
                </a>
                @endif

                <a class="auth-link" href="{{ route('register') }}">
                    {{ __('Want to register?') }}
                </a>



                <x-button class="ms-4" onclick="startSpinner()">
                    <span id="buttonText">{{ __('Log in') }}</span>
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
