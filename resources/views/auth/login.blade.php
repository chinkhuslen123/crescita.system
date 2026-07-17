<x-guest-layout>

    <div class="min-h-screen flex items-center justify-center bg-gray-100">

        <div class="w-full max-w-md bg-white rounded-2xl shadow-xl p-8">


            <div class="text-center mb-8">

                <div class="text-5xl mb-3">
                    ☕
                </div>


                <h1 class="text-3xl font-bold text-gray-800">
                    Cafe POS
                </h1>


                <p class="text-gray-500 mt-2">
                    Системд нэвтрэх
                </p>

            </div>



            <x-auth-session-status
                class="mb-4"
                :status="session('status')"
            />



            <form method="POST" action="{{ route('login') }}">

                @csrf



                <!-- Нэвтрэх нэр -->

                <div>

                    <x-input-label
                        for="email"
                        value="Нэвтрэх нэр"
                    />


                    <x-text-input

                        id="email"

                        class="block mt-2 w-full rounded-xl"

                        type="text"

                        name="email"

                        :value="old('email')"

                        placeholder="admin"

                        required

                        autofocus

                    />


                    <x-input-error

                        :messages="$errors->get('email')"

                        class="mt-2"

                    />

                </div>





                <!-- Нууц үг -->

                <div class="mt-5">


                    <x-input-label

                        for="password"

                        value="Нууц үг"

                    />



                    <x-text-input

                        id="password"

                        class="block mt-2 w-full rounded-xl"

                        type="password"

                        name="password"

                        placeholder="••••••••"

                        required

                    />



                    <x-input-error

                        :messages="$errors->get('password')"

                        class="mt-2"

                    />


                </div>





                <div class="mt-8">


                    <button

                        type="submit"

                        class="w-full bg-green-600 hover:bg-green-700 text-white font-bold py-3 rounded-xl transition"

                    >

                        🔓 Нэвтрэх


                    </button>


                </div>




            </form>



        </div>


    </div>


</x-guest-layout>