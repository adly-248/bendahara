{{-- <x-guest-layout>
    <!-- Session Status -->
    <x-auth-session-status class="mb-4" :status="session('status')" />

    <div class="flex justify-center mb-6">
        <!-- Besarin logo di sini -->
        <x-application-logo class="w-40 h-40" />
    </div>

    <form method="POST" action="{{ route('login') }}">
        @csrf

        <div class="p-6">
            <h2 class="text-xl font-semibold mb-4 text-gray-800">Masuk Bendahara</h2>

            <!-- Email Address -->
            <div>
                <x-input-label for="email" :value="__('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="mt-4">
                <x-input-label for="password" :value="__('Password')" />

                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />

                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="block mt-4">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="flex items-center justify-end mt-4">
                @if (Route::has('password.request'))
                    <a class="underline text-sm text-gray-600 hover:text-gray-900 rounded-md focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-indigo-500"
                        href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ms-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
    </form>
</x-guest-layout> --}}

<x-guest-layout>
    <style>
        body {
            background: linear-gradient(135deg, #DC143C 0%, #FF6B9D 25%, #FFB6C1 50%, #FFF0F5 75%, #FFFFFF 100%)
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            display: flex;
            align-items: center;
            justify-content: center;
            padding: 0;
            margin: 0;
            position: relative;
            overflow-x: hidden;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 80%, rgba(220, 20, 60, 0.2) 0%, transparent 50%),
                radial-gradient(circle at 80% 20%, rgba(255, 182, 193, 0.3) 0%, transparent 50%);
            pointer-events: none;
        }

        /* Override default Laravel styling */
        * {
            box-sizing: border-box;
        }

        .min-h-screen,
        .bg-gray-100,
        .bg-gray-50 {
            background: transparent !important;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.95);
            backdrop-filter: blur(20px);
            border-radius: 24px;
            box-shadow: 0 20px 40px rgba(220, 20, 60, 0.2);
            border: 1px solid rgba(220, 20, 60, 0.1);
            padding: 48px 40px;
            width: 100%;
            max-width: 450px;
            margin: auto;
            animation: fadeIn 0.6s ease;
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
                transform: translateY(20px);
            }

            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        .login-header {
            text-align: center;
            margin-bottom: 32px;
        }

        .logo-container {
            display: flex;
            justify-content: center;
            margin-bottom: 24px;
        }

        .logo-container svg,
        .logo-container img {
            width: 120px !important;
            height: 120px !important;
        }

        .login-title {
            font-size: 32px;
            font-weight: 800;
            background: linear-gradient(135deg, #DC143C 0%, #FF1493 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            margin-bottom: 8px;
        }

        .login-subtitle {
            color: #666;
            font-size: 16px;
            font-weight: 500;
        }

        .form-group {
            margin-bottom: 20px;
        }

        .form-group label {
            display: block;
            font-size: 14px;
            font-weight: 600;
            color: #374151;
            margin-bottom: 8px;
        }

        .form-group input[type="email"],
        .form-group input[type="password"] {
            width: 100% !important;
            padding: 14px 16px !important;
            border: 2px solid #e5e7eb !important;
            border-radius: 10px !important;
            font-size: 16px !important;
            background: #fafafa !important;
            transition: all 0.2s ease !important;
        }

        .form-group input:focus {
            outline: none !important;
            border-color: #DC143C !important;
            background: white !important;
            box-shadow: 0 0 0 3px rgba(220, 20, 60, 0.1) !important;
        }

        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 20px 0;
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 18px !important;
            height: 18px !important;
            accent-color: #DC143C !important;
        }

        .checkbox-wrapper label {
            font-size: 14px !important;
            color: #374151 !important;
            margin: 0 !important;
        }

        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 24px;
            gap: 16px;
        }

        .forgot-password {
            color: #DC143C !important;
            text-decoration: none !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            transition: color 0.2s ease !important;
            flex-shrink: 0;
        }

        .forgot-password:hover {
            color: #B0174B !important;
        }

        button[type="submit"] {
            padding: 14px 32px !important;
            background: linear-gradient(135deg, #DC143C 0%, #FF1493 100%) !important;
            color: white !important;
            border: none !important;
            border-radius: 10px !important;
            font-size: 16px !important;
            font-weight: 700 !important;
            cursor: pointer !important;
            transition: all 0.3s ease !important;
            box-shadow: 0 4px 15px rgba(220, 20, 60, 0.3) !important;
            display: inline-flex !important;
            align-items: center !important;
            justify-content: center !important;
            margin: 0 !important;
            flex-shrink: 0;
        }

        button[type="submit"]:hover {
            transform: translateY(-2px) !important;
            box-shadow: 0 6px 20px rgba(220, 20, 60, 0.4) !important;
        }

        button[type="submit"]:active {
            transform: translateY(0) !important;
        }

        /* Mobile Responsive */
        @media (max-width: 480px) {
            body {
                padding: 0;
            }

            .login-container {
                padding: 32px 24px;
                margin: 15px;
                max-width: calc(100% - 30px);
            }

            .logo-container svg,
            .logo-container img {
                width: 100px !important;
                height: 100px !important;
            }

            .login-title {
                font-size: 26px;
            }

            .login-subtitle {
                font-size: 14px;
            }

            .form-actions {
                flex-direction: column;
                align-items: stretch;
            }

            button[type="submit"] {
                width: 100% !important;
                order: 1;
            }

            .forgot-password {
                text-align: center;
                order: 2;
            }
        }
    </style>

    <div class="login-container">
        <div class="login-header">
            <!-- Session Status -->
            <x-auth-session-status class="mb-4" :status="session('status')" />

            <div class="logo-container">
                <!-- Besarin logo di sini -->
                <x-application-logo class="w-40 h-40" />
            </div>

            <h1 class="login-title">Welcome back</h1>
            <p class="login-subtitle">Sign in to your account to continue</p>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <!-- Email Address -->
            <div class="form-group">
                <x-input-label for="email" :value="'Email'" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')"
                    required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <x-input-label for="password" :value="'Password'" />
                <x-text-input id="password" class="block mt-1 w-full" type="password" name="password" required
                    autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="checkbox-wrapper">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox"
                        class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
                    <span class="ms-2 text-sm text-gray-600">{{ __('Remember me') }}</span>
                </label>
            </div>

            <div class="form-actions">
                @if (Route::has('password.request'))
                    <a class="forgot-password" href="{{ route('password.request') }}">
                        {{ __('Forgot your password?') }}
                    </a>
                @endif

                <x-primary-button class="ms-3">
                    {{ __('Log in') }}
                </x-primary-button>
            </div>
        </form>
    </div>
</x-guest-layout>
