<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="grid lg:grid-cols-4 gap-y-6">
            @foreach ($menus as $menu)
                <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                    <center>
                        <img class="w-50 h-48" src="{{ asset('images/menus/' . $menu->image) }}" alt="Image" />
                        <div class="px-6 py-4">
                            <h4 class="mb-3 text-xl font-semibold tracking-tight text-green-600 uppercase">
                                {{ $menu->name }}</h4>

                            <p class="leading-normal text-gray-700 text-clip overflow-hidden ...">
                                {{ $menu->description }}.
                            </p>
                            <div class="flex flex-col space-y-4 ...">
                                <span
                                    class="text-xl text-red-600">{{ number_format($menu->price, 0, '', ',') }}VND</span>
                            </div>
                        </div>
                    </center>
                </div>
            @endforeach
        </div>
    </div>
</x-guest-layout>
