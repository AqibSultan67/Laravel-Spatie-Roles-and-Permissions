<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Permissions') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900">
                   <form action="{{route('permissions.store')}}" method="POST">
                    @csrf
                     <div>
                        @if(session('success'))
                        <div class="alert alert-success">{{session('success')}}</div>
                        @endif

                        <label for="" class="text-lg font-medium">Permission Name</label>
                         <div class="my-3">
                           <input type="text" placeholder="Enter Permission" name="name" id="" class="border-gray-300 shadow-sm w-1/2 rounded-lg">
                         </div>
                         <button class="bg-slate-700 text-lg rounded-md text-white py-1 px-5 mt-3">Save</button>
                     </div>

                   </form>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
