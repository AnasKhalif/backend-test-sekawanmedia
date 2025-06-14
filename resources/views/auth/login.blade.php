@extends('auth.main')

@section('title')
    Vehicle Reservation System - Login
@endsection

@section('content')
    <div class="min-h-screen flex items-center justify-center py-12 px-4 sm:px-6 lg:px-8 backdrop-blur-sm bg-black/20">
        <div class="max-w-md w-full bg-white rounded-lg shadow-2xl overflow-hidden">
            <div class="px-8 pt-8 pb-6 bg-gradient-to-r from-gray-700 to-gray-900 text-center">
                <div class="inline-flex items-center justify-center w-16 h-16 rounded-full bg-white mb-4 shadow-lg">
                    <i class="fas fa-truck text-3xl text-amber-700"></i>
                </div>
                <h2 class="text-2xl font-bold text-white font-heading tracking-tight">Vehicle Management</h2>
                <p class="text-gray-200 text-sm mt-1">Enterprise Fleet System</p>
            </div>

            <div class="px-8 py-8">

                <form method="POST" action="{{ route('login') }}" class="space-y-6">
                    @csrf

                    <div>
                        <label for="email" class="block text-sm font-medium text-gray-700">Email</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-user text-amber-700"></i>
                            </div>
                            <input id="email" name="email" type="email" value="{{ old('email') }}" required
                                autofocus autocomplete="username"
                                class="focus:ring-amber-500 focus:border-amber-500 block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md text-sm @error('email') border-red-500 @enderror"
                                placeholder="Enter your email">
                        </div>
                        @error('email')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div>
                        <label for="password" class="block text-sm font-medium text-gray-700">Password</label>
                        <div class="mt-1 relative rounded-md shadow-sm">
                            <div class="absolute inset-y-0 left-0 pl-3 flex items-center pointer-events-none">
                                <i class="fas fa-lock text-amber-700"></i>
                            </div>
                            <input id="password" name="password" type="password" required autocomplete="current-password"
                                class="focus:ring-amber-500 focus:border-amber-500 block w-full pl-10 pr-3 py-3 border border-gray-300 rounded-md text-sm @error('password') border-red-500 @enderror"
                                placeholder="Enter your password">
                        </div>
                        @error('password')
                            <p class="mt-2 text-sm text-red-600">{{ $message }}</p>
                        @enderror
                    </div>

                    <div class="flex items-center justify-between">
                        <div class="flex items-center">
                            <input id="remember_me" name="remember" type="checkbox"
                                class="h-4 w-4 text-amber-600 focus:ring-amber-500 border-gray-300 rounded">
                            <label for="remember_me" class="ml-2 block text-sm text-gray-600">
                                Remember me
                            </label>
                        </div>
                        @if (Route::has('password.request'))
                            <div class="text-sm">
                                <a href="{{ route('password.request') }}"
                                    class="font-medium text-amber-700 hover:text-amber-500">
                                    Forgot your password?
                                </a>
                            </div>
                        @endif
                    </div>

                    <div>
                        <button type="submit"
                            class="group relative w-full flex justify-center py-3 px-4 border border-transparent text-sm font-medium rounded-md text-white bg-amber-700 hover:bg-amber-800 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-amber-500 transition duration-150 shadow-lg">
                            <span class="absolute left-0 inset-y-0 flex items-center pl-3">
                                <i class="fas fa-sign-in-alt text-white/70 group-hover:text-white/90"></i>
                            </span>
                            Log in
                        </button>
                    </div>
                </form>
            </div>

            <div
                class="px-8 py-4 bg-gray-100 border-t border-gray-200 flex justify-center text-xs text-gray-500 font-light">
                <span>© 2025 Mining Corporation • All Rights Reserved</span>
            </div>
        </div>
    </div>
@endsection
