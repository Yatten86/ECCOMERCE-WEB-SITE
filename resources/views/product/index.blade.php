<x-app-layout>
    <!-- Product List -->
    <div class="grid gap-6 grid-cols-1 md:grid-cols-2 lg:grid-cols-3 xl:grid-cols-4 p-5">
        @foreach ($products as $product)
            <!-- Product Item -->
            <div
                class="border border-1 border-gray-200 rounded-md hover:border-purple-600 transition-colors bg-white w-[300px] h-[450px] flex flex-col">
                <div class="flex items-center justify-center h-full">

                    <a href="{{route('product.view', $product->slug)}}" class="block overflow-hidden ">
                        <!-- Set a fixed height for the image container -->
                        <div class="h-[250px] w-full flex items-center justify-center p-4 ">
                            <!-- need to check the hover efect -->
                            <img src="{{$product->image}}" alt=""
                                class="object-contain h-full w-full transition-transform hover:scale-110 hover:rotate-2 rounded-lg" />
                        </div>
                    </a>
                </div>
                <div class="p-4 flex flex-col flex-grow">
                    <h3 class="text-lg font-semibold mb-2">
                        <a href="{{route('product.view', $product->slug)}}">
                            {{$product->title}}
                        </a>
                    </h3>
                    <h5 class="font-bold text-xl mb-4">€ {{$product->price}}</h5>
                </div>
                <div class="flex justify-between py-3 px-4 mt-auto">
                    <button @click="addToWatchlist()"
                        class="w-10 h-10 rounded-full border border-purple-600 flex items-center justify-center hover:bg-purple-600 hover:text-white active:bg-purple-800 transition-colors"
                        :class="isInWatchlist(id) ? 'bg-purple-600 text-white' : 'text-purple-600'">
                        <svg xmlns="http://www.w3.org/2000/svg" class="h-6 w-6" fill="none" viewBox="0 0 24 24"
                            stroke="currentColor" stroke-width="2">
                            <path stroke-linecap="round" stroke-linejoin="round"
                                d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z" />
                        </svg>
                    </button>
                    <button class="btn-primary" @click="addToCart(id)">
                        Add to Cart
                    </button>
                </div>
            </div>
        @endforeach
    </div>

    {{$products->links()}}
</x-app-layout>