<nav x-data="{ open: false }" class="bg-white border-b border-gray-200">

    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">

        <div class="flex justify-between h-16">


            <!-- Logo -->

            <div class="flex items-center">

                <a href="{{ route('dashboard') }}"
                   class="text-xl font-bold text-gray-800">

                    ☕ Cafe POS

                </a>


            </div>




            <!-- Desktop Menu -->

            <div class="hidden sm:flex items-center gap-6">


                <a href="{{ route('dashboard') }}"
                   class="text-gray-700 hover:text-green-600 font-semibold">

                    Dashboard

                </a>



                <form method="POST" action="{{ route('logout') }}">

                    @csrf


                    <button
                        type="submit"
                        class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-xl font-bold">

                        Гарах

                    </button>


                </form>


            </div>





            <!-- Mobile button -->

            <div class="sm:hidden flex items-center">


                <button
                    @click="open=!open"
                    class="text-gray-600 text-2xl">

                    ☰

                </button>


            </div>


        </div>


    </div>






    <!-- Mobile Menu -->

    <div
        x-show="open"
        class="sm:hidden border-t p-4 space-y-3">


        <a href="{{ route('dashboard') }}"
           class="block font-semibold text-gray-700">

            Dashboard

        </a>




        <form method="POST" action="{{ route('logout') }}">

            @csrf


            <button
                type="submit"
                class="w-full bg-red-500 text-white px-4 py-2 rounded-xl">

                Гарах

            </button>


        </form>


    </div>



</nav>