<x-app-layout>
    <div class="p-6 bg-white rounded-md shadow-md overflow-hidden flex flex-col md:flex-row ">
        @php
            $items = [['label' => 'Home', 'url' => route('admin.users')], ['label' => 'Edit User', 'url' => '#']];
        @endphp

        <x-my-components.breadcrumb :items="$items" />

    </div>
    <div class="p-6 mt-2 bg-white rounded-md shadow-md overflow-hidden flex flex-col md:flex-row justify-around ">
        <div class="max-w-md mx-autorounded-md overflow-hidden">
            <div class="p-6">
                <h2 class="text-2xl font-semibold mb-6">Edit User Account</h2>
                <form method="POST" action="{{ route('admin.edit.user.submit', $user->id) }}">
                    @csrf
                    <div class="mb-4">
                        <label for="floating_email" class="block text-sm font-medium text-gray-700">Email
                            address</label>
                        <input type="email" value="{{ old('email', $user->email) }}" name="email"
                            id="floating_email" placeholder="Email address"
                            class="mt-1 block w-full py-2.5 px-4 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm">
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="floating_password"
                                class="block text-sm font-medium text-gray-700">Password</label>
                            <input type="password" name="password" id="floating_password" placeholder="Password"
                                class="mt-1 block w-full py-2.5 px-4 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm">
                        </div>
                        <div class="mb-4">
                            <label for="floating_repeat_password"
                                class="block text-sm font-medium text-gray-700">Confirm password</label>
                            <input type="password" name="password_confirmation" id="floating_repeat_password"
                                placeholder="Confirm password"
                                class="mt-1 block w-full py-2.5 px-4 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm">
                        </div>
                    </div>
                    <div class="grid grid-cols-2 gap-4">
                        <div class="mb-4">
                            <label for="floating_first_name" class="block text-sm font-medium text-gray-700">Full
                                name</label>
                            <input type="text" value="{{ old('name', $user->name) }}" name="name"
                                id="floating_first_name" placeholder="First name"
                                class="mt-1 block w-full py-2.5 px-4 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm">
                        </div>

                        <div class="mb-4">
                            <label for="floating_phone" class="block text-sm font-medium text-gray-700">Phone
                                number</label>
                            <input type="tel" value="{{ old('phone', $user->phone) }}" name="phone"
                                id="floating_phone" placeholder="Phone number"
                                class="mt-1 block w-full py-2.5 px-4 border border-gray-300 rounded-md focus:ring-blue-500 focus:border-blue-500 shadow-sm text-sm">
                        </div>
                    </div>
                    <button type="submit"
                        class="mt-4 w-full inline-flex items-center justify-center px-4 py-2 border border-transparent rounded-md shadow-sm text-base font-medium text-white bg-blue-600 hover:bg-blue-700 focus:outline-none focus:ring-2 focus:ring-offset-2 focus:ring-blue-500">
                        Submit
                    </button>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
