@extends('layouts.app')

@section('content')
    <div class="bg-gray-100 flex items-center justify-center min-h-screen py-12 px-6 custom-bg">
        <div class="bg-white shadow-md rounded-lg w-full max-w-2xl p-6">
            <h2 class="text-3xl font-semibold text-gray-900 mb-6">Alergeny</h2>

            <div class="flex flex-col sm:text-left gap-4">
                @foreach ($allergens as $name => $number)
                    <div class="flex items-center justify-start bg-white text-gray-900 p-2 rounded-lg border border-gray-300">
                        <span class="bg-yellow-500 text-black rounded-full px-3 py-1 text-sm mr-2">{{ $name }}</span>
                        <span class="text-sm">{{ $number }}</span>
                    </div>
                @endforeach
            </div>
        </div>
    </div>
@endsection
