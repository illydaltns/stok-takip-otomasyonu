<!doctype html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta
      name="viewport"
      content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0"
    />
    <meta http-equiv="X-UA-Compatible" content="ie=edge" />
    <title>Sign In| TailAdmin - Tailwind CSS Admin Dashboard Template</title>
  <link rel="icon" href="favicon.ico"><link href="style.css" rel="stylesheet"></head>
  <body
    x-data="{ page: 'comingSoon', 'loaded': true, 'darkMode': false, 'stickyMenu': false, 'sidebarToggle': false, 'scrollTop': false }"
    x-init="
         darkMode = JSON.parse(localStorage.getItem('darkMode'));
         $watch('darkMode', value => localStorage.setItem('darkMode', JSON.stringify(value)))"
    :class="{'dark bg-gray-900': darkMode === true}"
  >
    <!-- ===== Preloader Start ===== -->
    <div
  x-show="loaded"
  x-init="window.addEventListener('DOMContentLoaded', () => {setTimeout(() => loaded = false, 500)})"
  class="fixed left-0 top-0 z-999999 flex h-screen w-screen items-center justify-center bg-white dark:bg-black"
>
  <div
    class="h-16 w-16 animate-spin rounded-full border-4 border-solid border-brand-500 border-t-transparent"
  ></div>
</div>

    <!-- ===== Preloader End ===== -->

    <!-- ===== Page Wrapper Start ===== -->
    <div class="relative p-6 bg-white z-1 dark:bg-gray-900 sm:p-0">
      <div
        class="relative flex flex-col justify-center w-full h-screen dark:bg-gray-900 sm:p-0 lg:flex-row"
      >
        <!-- Form -->
        <div class="flex flex-col flex-1 w-full lg:w-1/2">
          
          <div
            class="flex flex-col justify-center flex-1 w-full max-w-md mx-auto"
          >
            <div>
              <div class="mb-5 sm:mb-8">
                <h1
                  class="mb-2 font-semibold text-gray-800 text-title-sm dark:text-white/90 sm:text-title-md"
                >
                    Forgot your password?
                </h1>
                <p class="text-sm text-gray-500 dark:text-gray-400">
                No problem. Just let us know your email address and we will email you a password reset link that will allow you to choose a new one.
                </p>
              </div>
              <div>
                
                <div class="relative py-3 sm:py-5">
                  <div class="absolute inset-0 flex items-center">
                    <div
                      class="w-full border-t border-gray-200 dark:border-gray-800"
                    ></div>
                  </div>
                  
                </div>
               

        <!-- Email Address -->
                    <form method="POST" action="{{ route('password.email') }}">
                @csrf

                <div class="mb-4">
                    <label for="email" class="block text-sm font-medium text-gray-700">
                        Email <span class="text-error-500">*</span>
                    </label>

                    <input type="email" id="email" name="email" placeholder="Enter your email"
                        class="dark:bg-dark-900 h-11 w-full rounded-lg border border-gray-300 bg-transparent px-4 py-2.5 text-sm text-gray-800 shadow-theme-xs placeholder:text-gray-400 focus:border-brand-300 focus:outline-hidden focus:ring-3 focus:ring-brand-500/10 dark:border-gray-700 dark:bg-gray-900 dark:text-white/90 dark:placeholder:text-white/30 dark:focus:border-brand-800" required autofocus>
                        @if ($errors->has('email'))
                            <p class="mt-2 text-sm text-red-600">{{ $errors->first('email') }}</p>
                        @elseif (session('status'))
                            <p class="mt-2 text-sm text-green-600">{{ session('status') }}</p>
                        @endif

                </div>


                <div>
                    <button type="submit"
                        class="flex items-center justify-center w-full px-4 py-3 text-sm font-medium text-white transition rounded-lg bg-brand-500 shadow-theme-xs hover:bg-brand-600">
                        Send Reset Link
                    </button>
                </div>
            </form>

             

                <div class="mt-5">
                    

                    

                    <p class="text-sm font-normal text-center text-gray-700 dark:text-gray-400 sm:text-start">
                        Remembered your password?
                        <a href="{{ route('login') }}" class="text-brand-500 hover:text-brand-600 dark:text-brand-400">
                            Log in instead.
                        </a>
                    </p>
                </div>
              </div>
            </div>
          </div>
        </div>

        
        <!-- Toggler -->
        
      </div>
    </div>
    <!-- ===== Page Wrapper End ===== -->
  <script defer src="bundle.js"></script></body>
</html>
