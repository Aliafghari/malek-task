{{-- <x-guest-layout>
    @php
    //var_dump(session('reset_password_random_num'))
        $resetNum = request('reset_num');
        $token = request('token');
        $displayForm = false;
        $email = old('email', $request->email);
        $errors = session('errors') ?? new Illuminate\Support\MessageBag();
    @endphp

    @if ($errors->any())
        <div class="mb-4 font-medium text-red-600">
            {{ __('Whoops! Something went wrong.') }}
        </div>

        <div class="alert alert-danger">
            <ul class="mb-0 mt-0 list-disc list-inside text-sm text-red-600">
                @foreach ($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form method="POST" action="{{ route('password.update') }}">
        @csrf
        @method('PUT')

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $token }}">

        <!-- Random Number Input -->
        <div>
            <label for="random_num">Enter the verification code:</label>
            <input id="random_num" class="block mt-1 w-full" type="text" name="random_num" required />
            <x-input-error :messages="$errors->get('random_num')" class="mt-2" />
        </div>

        <!-- Check the random number and show Email and Password fields if matched -->
        @if ($resetNum && $token && $displayForm)
            <script>
                function checkRandomNum() {
                    const randomNum = document.getElementById('random_num').value.trim();
                    // Replace the 'YOUR_SESSION_RANDOM_NUM' with the actual session random number
                    const sessionRandomNum = '{{ session('reset_password_random_num') }}';
                    if (randomNum === sessionRandomNum) {
                        document.getElementById('random_num').disabled = true;
                        document.getElementById('email').style.display = 'block';
                        document.getElementById('password').style.display = 'block';
                        document.getElementById('password_confirmation').style.display = 'block';
                        document.querySelector('button[type="submit"]').textContent = '{{ __("Reset Password") }}';
                        document.querySelector('button[type="submit"]').removeAttribute('onclick');
                    } else {
                        alert('The code you entered is invalid. Please try again.');
                    }
                }
            </script>

            <div class="mt-4">
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="$email"
                    required autofocus autocomplete="username" style="display: none;" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="new-password" style="display: none;" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <div class="mt-4">
                <x-input-label for="password_confirmation" :value="__('Confirm Password')" />
                <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                    name="password_confirmation" required autocomplete="new-password" style="display: none;" />
                <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
            </div>
        @endif

        <div class="flex items-center justify-end mt-4">
            <button type="submit" @if ($resetNum && $token && !$displayForm) onclick="checkRandomNum();"
                @endif>
                @if ($resetNum && $token && $displayForm)
                    {{ __('Reset Password') }}
                @else
                    {{ __('Verify Code') }}
                @endif
            </button>
        </div>
    </form>
</x-guest-layout> --}}


<x-guest-layout>
    <form method="POST" action="{{ route('password.store') }}">
        @csrf

        <!-- Password Reset Token -->
        <input type="hidden" name="token" value="{{ $request->route('token') }}">


        <!-- Random Number -->
        <div>
            <x-input-label for="random_num" :value="__('Code')" />
            <x-text-input id="random_num" class="block mt-1 w-full" type="text" name="random_num" :value="old('random_num')"
                required />
            <x-input-error :messages="$errors->get('random_num')" class="mt-2" />
        </div>

        <!-- Password -->
        <div class="mt-4">
            <x-input-label for="password" :value="__('Password')" />
            <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                autocomplete="new-password" />
            <x-input-error :messages="$errors->get('password')" class="mt-2" />
        </div>

        <!-- Confirm Password -->
        <div class="mt-4">
            <x-input-label for="password_confirmation" :value="__('Confirm Password')" />

            <x-text-input id="password_confirmation" class="block mt-1 w-full" type="password"
                name="password_confirmation" required autocomplete="new-password" />

            <x-input-error :messages="$errors->get('password_confirmation')" class="mt-2" />
        </div>

        <div class="flex items-center justify-end mt-4">
            <x-primary-button>
                {{ __('Reset Password') }}
            </x-primary-button>
        </div>
    </form>
</x-guest-layout>
