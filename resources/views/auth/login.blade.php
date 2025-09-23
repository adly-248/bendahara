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
            background: linear-gradient(135deg, #8B0000 0%, #DC143C 25%, #B22222 75%, #660000 100%);
            min-height: 100vh;
            font-family: 'Inter', -apple-system, BlinkMacSystemFont, sans-serif;
            position: relative;
        }

        body::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background: radial-gradient(circle at 20% 80%, rgba(220, 20, 60, 0.3) 0%, transparent 50%),
                        radial-gradient(circle at 80% 20%, rgba(139, 0, 0, 0.4) 0%, transparent 50%),
                        radial-gradient(circle at 40% 40%, rgba(128, 0, 32, 0.2) 0%, transparent 50%);
            pointer-events: none;
        }

        .login-container {
            background: rgba(255, 255, 255, 0.98);
            backdrop-filter: blur(25px);
            border-radius: 28px;
            box-shadow: 0 25px 50px rgba(139, 0, 0, 0.3),
                        0 0 0 1px rgba(255, 255, 255, 0.3),
                        inset 0 1px 0 rgba(255, 255, 255, 0.4);
            border: 1px solid rgba(220, 20, 60, 0.1);
            padding: 52px 44px;
            width: 100%;
            max-width: 450px;
            margin: 0 auto;
            transform: translateY(0);
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
            animation: fadeIn 0.8s cubic-bezier(0.4, 0, 0.2, 1);
            position: relative;
        }

        .login-container::before {
            content: '';
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            border-radius: 28px;
            padding: 1px;
            background: linear-gradient(145deg, rgba(220, 20, 60, 0.3), rgba(139, 0, 0, 0.2), rgba(178, 34, 34, 0.3));
            mask: linear-gradient(#fff 0 0) content-box, linear-gradient(#fff 0 0);
            mask-composite: exclude;
            pointer-events: none;
        }

        .login-container:hover {
            transform: translateY(-8px);
            box-shadow: 0 35px 70px rgba(139, 0, 0, 0.4),
                        0 0 0 1px rgba(255, 255, 255, 0.3),
                        inset 0 1px 0 rgba(255, 255, 255, 0.4);
        }

        @keyframes fadeIn {
            from { opacity: 0; transform: translateY(20px); }
            to { opacity: 1; transform: translateY(0); }
        }

        .login-header {
            text-align: center;
            margin-bottom: 40px;
        }

        /* Logo container styling untuk x-application-logo */
        .logo-container {
            display: flex;
            justify-content: center;
            margin-bottom: 28px;
        }

        .login-title {
            font-size: 36px;
            font-weight: 800;
            color: #2d1b1b;
            margin-bottom: 12px;
            letter-spacing: -0.8px;
            background: linear-gradient(135deg, #8B0000 0%, #DC143C 100%);
            -webkit-background-clip: text;
            -webkit-text-fill-color: transparent;
            background-clip: text;
            text-shadow: 0 2px 4px rgba(139, 0, 0, 0.1);
        }

        .login-subtitle {
            color: #666;
            font-size: 17px;
            font-weight: 500;
            opacity: 0.8;
        }

        /* Enhanced form styling */
        .form-group {
            margin-bottom: 24px;
            position: relative;
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
            padding: 16px 20px !important;
            border: 2px solid #e5e7eb !important;
            border-radius: 12px !important;
            font-size: 16px !important;
            transition: all 0.2s ease !important;
            background: #fafafa !important;
            box-shadow: none !important;
        }

        .form-group input[type="email"]:focus,
        .form-group input[type="password"]:focus {
            outline: none !important;
            border-color: #DC143C !important;
            background: white !important;
            box-shadow: 0 0 0 4px rgba(220, 20, 60, 0.15),
                        0 0 20px rgba(139, 0, 0, 0.1) !important;
            ring: none !important;
        }

        .form-group input[type="email"]:hover,
        .form-group input[type="password"]:hover {
            border-color: #d1d5db !important;
            background: white !important;
        }

        /* Error messages styling */
        .text-red-600,
        .text-sm.text-red-600 {
            background: #fef2f2;
            border: 1px solid #fecaca;
            color: #dc2626 !important;
            padding: 8px 12px;
            border-radius: 8px;
            font-size: 13px;
            margin-top: 8px;
            display: block;
        }

        /* Success messages styling */
        .mb-4 > div {
            background: #f0f9f4;
            border: 1px solid #bbf7d0;
            color: #166534;
            padding: 12px 16px;
            border-radius: 8px;
            font-size: 14px;
            margin-bottom: 20px;
        }

        /* Remember me checkbox styling */
        .checkbox-wrapper {
            display: flex;
            align-items: center;
            gap: 8px;
            margin: 24px 0;
        }

        .checkbox-wrapper input[type="checkbox"] {
            width: 18px !important;
            height: 18px !important;
            accent-color: #DC143C !important;
            border-radius: 4px !important;
        }

        .checkbox-wrapper label {
            font-size: 14px !important;
            color: #374151 !important;
            margin: 0 !important;
        }

        /* Footer actions styling */
        .form-actions {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-top: 32px;
        }

        .forgot-password {
            color: #B22222 !important;
            text-decoration: none !important;
            font-size: 14px !important;
            font-weight: 600 !important;
            transition: all 0.3s ease !important;
            position: relative !important;
        }

        .forgot-password:hover {
            color: #8B0000 !important;
            text-decoration: none !important;
            text-shadow: 0 0 8px rgba(139, 0, 0, 0.3) !important;
        }

        .forgot-password::after {
            content: '';
            position: absolute;
            width: 0;
            height: 2px;
            bottom: -2px;
            left: 0;
            background: linear-gradient(90deg, #8B0000, #DC143C);
            transition: width 0.3s ease;
        }

        .forgot-password:hover::after {
            width: 100%;
        }

        /* Primary button styling */
        button[type="submit"],
        .bg-gray-800 {
            width: auto !important;
            padding: 18px 36px !important;
            background: linear-gradient(135deg, #8B0000 0%, #DC143C 50%, #B22222 100%) !important;
            color: white !important;
            border: none !important;
            border-radius: 14px !important;
            font-size: 16px !important;
            font-weight: 700 !important;
            cursor: pointer !important;
            transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1) !important;
            position: relative !important;
            overflow: hidden !important;
            margin-left: 16px !important;
            box-shadow: 0 8px 25px rgba(139, 0, 0, 0.3),
                        inset 0 1px 0 rgba(255, 255, 255, 0.2) !important;
            text-shadow: 0 1px 2px rgba(0, 0, 0, 0.2) !important;
        }

        button[type="submit"]::before {
            content: '';
            position: absolute;
            top: 0;
            left: -100%;
            width: 100%;
            height: 100%;
            background: linear-gradient(90deg, transparent, rgba(255,255,255,0.3), transparent);
            transition: left 0.6s ease;
        }

        button[type="submit"]::after {
            content: '';
            position: absolute;
            top: 50%;
            left: 50%;
            width: 0;
            height: 0;
            background: radial-gradient(circle, rgba(255,255,255,0.3) 0%, transparent 70%);
            transform: translate(-50%, -50%);
            border-radius: 50%;
            transition: width 0.6s ease, height 0.6s ease;
        }

        button[type="submit"]:hover {
            transform: translateY(-3px) !important;
            box-shadow: 0 15px 35px rgba(139, 0, 0, 0.5),
                        inset 0 1px 0 rgba(255, 255, 255, 0.3) !important;
            background: linear-gradient(135deg, #A0000A 0%, #E6164D 50%, #C23333 100%) !important;
        }

        button[type="submit"]:hover::before {
            left: 100%;
        }

        button[type="submit"]:hover::after {
            width: 300px;
            height: 300px;
        }

        button[type="submit"]:active {
            transform: translateY(-1px) !important;
            box-shadow: 0 8px 20px rgba(139, 0, 0, 0.4) !important;
        }

        /* Mobile responsiveness */
        @media (max-width: 480px) {
            .login-container {
                padding: 32px 24px;
                margin: 20px;
            }

            .login-title {
                font-size: 28px;
            }

            .form-actions {
                flex-direction: column;
                gap: 16px;
                align-items: stretch;
            }

            button[type="submit"] {
                width: 100% !important;
                margin-left: 0 !important;
            }
        }

        /* Focus states for accessibility */
        .forgot-password:focus {
            outline: 2px solid #DC143C !important;
            outline-offset: 3px !important;
            border-radius: 6px !important;
            box-shadow: 0 0 0 4px rgba(220, 20, 60, 0.1) !important;
        }

        button[type="submit"]:focus {
            outline: 2px solid #DC143C !important;
            outline-offset: 3px !important;
            box-shadow: 0 8px 25px rgba(139, 0, 0, 0.3),
                        0 0 0 4px rgba(220, 20, 60, 0.2) !important;
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
                <x-input-label for="email" :value="('Email')" />
                <x-text-input id="email" class="block mt-1 w-full" type="email" name="email" :value="old('email')" required autofocus autocomplete="username" />
                <x-input-error :messages="$errors->get('email')" class="mt-2" />
            </div>

            <!-- Password -->
            <div class="form-group">
                <x-input-label for="password" :value="('Password')" />
                <x-text-input id="password" class="block mt-1 w-full"
                                type="password"
                                name="password"
                                required autocomplete="current-password" />
                <x-input-error :messages="$errors->get('password')" class="mt-2" />
            </div>

            <!-- Remember Me -->
            <div class="checkbox-wrapper">
                <label for="remember_me" class="inline-flex items-center">
                    <input id="remember_me" type="checkbox" class="rounded border-gray-300 text-indigo-600 shadow-sm focus:ring-indigo-500" name="remember">
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
