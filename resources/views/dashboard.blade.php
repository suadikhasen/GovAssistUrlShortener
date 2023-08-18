<x-app-layout>
    <div class="flex justify-center mx-auto py-12 mt-16 ">
        <div class=" flex flex-col space-y-12 w-[95%] max-w-[1000px]">
            <form class="flex items-start justify-between mb-6 bg-white p-8 rounded-md shadow" method="post" action="{{route('shorten_url')}}">
                @csrf
                    <div class="w-3/4 flex flex-col items-start space-y-2">
                   <input type="text" name="destination" class="w-full px-4 py-2 rounded-l-md border border-gray-300 focus:ring focus:ring-blue-200 focus:outline-none" placeholder="Enter your URL" autofocus>
                        @error('destination')
                          <h1 class="text-red-500">{{ $message }}</h1>
                        @enderror
                        @if(session()->has('success'))
                            <h1 class="text-green-600">{{ session()->get('success') }}</h1>
                        @endif
                    </div>
                    <div class="w-1/4 ml-2">
                        <button class="w-full py-2 rounded-md bg-blue-500 text-white hover:bg-blue-600 focus:outline-none" type="submit">Shorten</button>
                    </div>
            </form>


            <div class="flex flex-col items-start">

            <h2 class="text-xl font-semibold mb-4"> latest links</h2>
             <div class="w-full mt-2  bg-white p-8 rounded-md shadow" >
                <table class="w-full divide-y divide-slate-200 space-y-6">
                    <thead class="h-[40px]">
                    <tr>
                        <th class="text-left w-[40%]">URL</th>
                        <th class="text-left w-[40%]">Short URL</th>
                        <th class="text-left">Number of Views</th>
                    </tr>
                    </thead>

                    <tbody class="">
                    @if(isset($links))
                        @foreach($links as $link)
                            <tr>
                                <td>{{ $link->destination }}</td>
                                <td>{{ $link->shortened_url }}</td>
                                <td>{{ $link->views }}</td>
                            </tr>
                        @endforeach
                    @endif
                    </tbody>
                </table>
             </div>
            </div>
        </div>
    </div>
</x-app-layout>
