<x-guest-layout>
    <div class="container w-full px-5 py-6 mx-auto">
        <div class="grid lg:grid-cols-4 gap-y-6">
            @foreach ($categories as $category)
                <div class="max-w-xs mx-4 mb-2 rounded-lg shadow-lg">
                    <center>
                        <a href="{{ route('categories.show', $category->id) }}">
                            <img class="w-50 h-48" src="{{ asset('images/categories/' . $category->image) }}"
                                alt="Image" />
                        </a>
                        <div class="px-6 py-4">

                            <a href="{{ route('categories.show', $category->id) }}">
                                <h4
                                    class="mb-3 text-xl font-semibold tracking-tight text-green-600 hover:text-green-400 uppercase">
                                    {{ $category->name }}</h4>
                            </a>
                        </div>
                    </center>
                </div>
            @endforeach
        </div>
    </div>
</x-guest-layout>
