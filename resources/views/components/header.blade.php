    <header class="fixed w-full">
        <nav id="menu" class="bg-white border-gray-200 py-2.5 dark:bg-gray-900">
            <div class="flex flex-wrap items-center justify-between max-w-screen-xl px-4 mx-auto">
                <a href="{{ route('home') }}" class="flex items-center">
                    <img src="{{ asset('images/lumagraph.svg') }}" width="36" class="h-6 mr-3 sm:h-9 darkmode" alt="Lumagraph Logo" />
                    <span class="self-center text-xl font-semibold whitespace-nowrap dark:text-white">Lumagraph</span>
                </a>
                <div class="flex items-center lg:order-2">
                    <!-- <div class="hidden mt-2 mr-4 sm:inline-block">
                        <a class="github-button" href="https://github.com/themesberg/Lumagraph" data-size="large" data-icon="octicon-star" data-show-count="true" aria-label="Star themesberg/Lumagraph on GitHub">Star</a>
                    </div> -->
                    <!-- <a href="#" class="text-gray-900 dark:text-white hover:bg-gray-50 focus:ring-4 focus:ring-gray-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 sm:mr-2 dark:hover:bg-gray-800 focus:outline-none dark:focus:ring-gray-900">Log in</a> -->
                    <a href="{{ route('contact') }}" class="text-white bg-blue-800 hover:bg-blue-900 focus:ring-4 focus:ring-blue-300 font-medium rounded-lg text-sm px-4 lg:px-5 py-2 lg:py-2.5 sm:mr-2 lg:mr-0 dark:bg-blue-600 dark:hover:bg-blue-800 focus:outline-none dark:focus:ring-blue-900">Get quote</a>
                    <span class="lg:hidden">
                    <button data-collapse-toggle="mobile-menu-2" type="button" class="inline-flex items-center p-2 ml-1 text-sm text-gray-500 rounded-lg lg:hidden hover:bg-gray-100 focus:outline-none focus:ring-2 focus:ring-gray-200 dark:text-gray-400 dark:hover:bg-gray-800 dark:focus:ring-gray-600" aria-controls="mobile-menu-2" aria-expanded="false">
                        <span class="sr-only">Open main menu</span>
                        <svg class="w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M3 5a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 10a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1zM3 15a1 1 0 011-1h12a1 1 0 110 2H4a1 1 0 01-1-1z" clip-rule="evenodd"></path></svg>
                        <svg class="hidden w-6 h-6" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                    </button>
                    </span>
                </div>
                <div class="items-center justify-between hidden w-full lg:flex lg:w-auto lg:order-1" id="mobile-menu-2">
                <ul class="flex mb-2 flex-col mt-4 font-medium lg:flex-row lg:space-x-8 lg:mt-0">
                    <li>
                        <a href="{{ route('home') }}" 
                        class="block py-2 pl-3 pr-4 rounded {{ request()->routeIs('home') ? 'text-white bg-blue-800 lg:bg-transparent lg:text-blue-800 lg:p-0 dark:text-white' : 'text-gray-800 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-800 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-800 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-800' }}" 
                        {{ request()->routeIs('home') ? 'aria-current="page"' : '' }}>
                            Home
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('products') }}" 
                        class="block py-2 pl-3 pr-4 rounded {{ request()->routeIs('products') ? 'text-white bg-blue-800 lg:bg-transparent lg:text-blue-800 lg:p-0 dark:text-white' : 'text-gray-800 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-800 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-800 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-800' }}" 
                        {{ request()->routeIs('products') ? 'aria-current="page"' : '' }}>
                            Products
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('team') }}" 
                        class="block py-2 pl-3 pr-4 rounded {{ request()->routeIs('team') ? 'text-white bg-blue-800 lg:bg-transparent lg:text-blue-800 lg:p-0 dark:text-white' : 'text-gray-800 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-800 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-800 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-800' }}" 
                        {{ request()->routeIs('team') ? 'aria-current="page"' : '' }}>
                            Team
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('blog') }}" 
                        class="block py-2 pl-3 pr-4 rounded {{ request()->routeIs('blog') ? 'text-white bg-blue-800 lg:bg-transparent lg:text-blue-800 lg:p-0 dark:text-white' : 'text-gray-800 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-800 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-800 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-800' }}" 
                        {{ request()->routeIs('blog') ? 'aria-current="page"' : '' }}>
                            Blog
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('contact') }}" 
                        class="block py-2 pl-3 pr-4 rounded {{ request()->routeIs('contact') ? 'text-white bg-blue-800 lg:bg-transparent lg:text-blue-800 lg:p-0 dark:text-white' : 'text-gray-800 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-800 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-800 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-800' }}" 
                        {{ request()->routeIs('contact') ? 'aria-current="page"' : '' }}>
                            Contact
                        </a>
                    </li>
                    <li class="block py-2 pl-3 pr-4 text-gray-800 border-b border-gray-100 hover:bg-gray-50 lg:hover:bg-transparent lg:border-0 lg:hover:text-blue-800 lg:p-0 dark:text-gray-400 lg:dark:hover:text-white dark:hover:bg-gray-800 dark:hover:text-white lg:dark:hover:bg-transparent dark:border-gray-800">
                        <button data-modal-toggle="loginModal" id="loginButton" aria-label="user login" >
                            Login
                        </button>
                    </li>
                </ul>

                    <button 
                    id="toggleButton" 
                        style="margin:-6px;" 
                        class="hidden absolute bottom-1 left-1/2 transform -translate-x-1/2 w-1/5" 
                        aria-hidden="false" 
                        aria-label="Toggle navigation menu"
                    >
                        <span style="display:block" class="h-0.5 m-2 bg-black"></span>
                    </button>
                </div>
            </div>
        </nav>
    </header>

    <!-- Login modal -->
    <div id="loginModal" tabindex="-1" aria-hidden="true" data-modal-target="loginModal"  class="defaultModal hidden overflow-y-auto overflow-x-hidden fixed top-0 right-0 left-0 z-50  h-full md:inset-0 h-modal lg:max-w-lg" style="margin:auto;">
        <div class="relative  p-4 w-full max-w-2xl h-full md:h-auto">
            <!-- Modal content -->
            <div class="relative bg-white rounded-lg shadow dark:bg-gray-700">
                <!-- Modal header -->
                <div class="flex justify-between items-start p-4 rounded-t border-b dark:border-gray-600">
                    <h3 class="text-xl font-semibold text-gray-900 dark:text-white">
                    User login
                    </h3>
                    <button type="button" class="text-gray-400 bg-transparent hover:bg-gray-200 hover:text-gray-900 rounded-lg text-sm p-1.5 ml-auto inline-flex items-center dark:hover:bg-gray-600 dark:hover:text-white" data-modal-toggle="loginModal">
                        <svg aria-hidden="true" class="w-5 h-5" fill="currentColor" viewBox="0 0 20 20" xmlns="http://www.w3.org/2000/svg"><path fill-rule="evenodd" d="M4.293 4.293a1 1 0 011.414 0L10 8.586l4.293-4.293a1 1 0 111.414 1.414L11.414 10l4.293 4.293a1 1 0 01-1.414 1.414L10 11.414l-4.293 4.293a1 1 0 01-1.414-1.414L8.586 10 4.293 5.707a1 1 0 010-1.414z" clip-rule="evenodd"></path></svg>
                        <span class="sr-only">Close</span>
                    </button>
                </div>
                <!-- Modal body -->
                <div class="p-6 space-y-6">
                    <form id="contactForm" method="post" action="{{ route('auth.login') }}">
                        @csrf
                        <div class="mb-6">
                            <div class="mx-0 mb-1 sm:mb-4">
                                <!-- Username Input -->
                                <div class="mx-0 mb-1 sm:mb-4">
                                    <label for="username" class="pb-1 text-xs uppercase tracking-wider">
                                        Username
                                    </label>
                                    <input 
                                        type="email" 
                                        id="username" 
                                        name="username" 
                                        autocomplete="email" 
                                        required 
                                        placeholder="Enter your username" 
                                        class="mb-2 w-full rounded-md border border-gray-400 py-2 pl-2 pr-4 shadow-md dark:text-gray-300 sm:mb-0"
                                        aria-required="true" 
                                        aria-label="Enter your username"
                                    >
                                </div>
                                <!-- Password Input -->
                                <div class="mx-0 mb-1 sm:mb-4">
                                    <label for="password" class="pb-1 text-xs uppercase tracking-wider">
                                        Password
                                    </label>
                                    <input 
                                        type="password" 
                                        id="password" 
                                        name="password" 
                                        autocomplete="current-password" 
                                        required 
                                        placeholder="Enter your password" 
                                        class="mb-2 w-full rounded-md border border-gray-400 py-2 pl-2 pr-4 shadow-md dark:text-gray-300 sm:mb-0"
                                        aria-required="true" 
                                        aria-label="Enter your password"
                                    >
                                </div>
                            </div>
                        </div>
                        <!-- Submit Button -->
                        <div class="flex items-center justify-center">
                            <div 
                                class="relative inline-flex items-center justify-center p-0.5 mb-2 me-2 overflow-hidden text-sm font-medium text-gray-900 rounded-lg group bg-gradient-to-br from-purple-600 to-blue-500 group-hover:from-purple-600 group-hover:to-blue-500 hover:text-white dark:text-white focus:ring-4 focus:outline-none focus:ring-blue-300 dark:focus:ring-blue-800"
                                role="button"
                                aria-label="Submit login form"
                            >
                                <button 
                                    type="submit" 
                                    class="relative px-5 py-2.5 transition-all ease-in duration-75 bg-white dark:bg-gray-900 rounded-md group-hover:bg-opacity-0"
                                >
                                    Login
                                </button>
                            </div>
                        </div>
                    </form>
                   
                </div>
    <!-- Login footer -->
            </div>
        </div>
    </div>  