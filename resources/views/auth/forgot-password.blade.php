<x-app-layout>

    <!-- Session Status -->



    <form action="{{ route('password.email') }}" method="post" class="w-[400px] mx-auto p-6 my-16 bg-white rounded-md">
        <!-- <x-auth-validation-errors class="mb-4" :errors="$errors" /> -->
        <x-auth-session-status class="mb-4 text-center" :status="session('status')" />
        @csrf
        <div class="mb-4 text-sm text-gray-600 justify-center items-center text-center">
            {{ __('Forgot your password? No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.') }}
        </div>


        <h2 class="text-2xl font-semibold text-center mb-5">
            Enter your Email to reset password
        </h2>
        <p class="text-center text-gray-500 mb-6">
            or
            <a href="{{route('login')}}" class="text-purple-600 hover:text-purple-500">login with existing
                account</a>
        </p>

        <div class="mb-3">
            <x-text-input id="loginEmail" type="email" name="email" :value="old('email')" required autofocus
                placeholder="Your email address" />
        </div>
        <x-primary-button>
            Submit
        </x-primary-button>
    </form>

</x-app-layout>