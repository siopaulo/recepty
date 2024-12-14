@extends('layouts.app')

@section('content')
    <div class="bg-gradient-to-r from-gray-800 via-gray-900 to-black min-h-screen py-12 px-6 flex flex-col items-center custom-bg">

        <div class="text-3xl font-bold text-white mb-10">
            <span class="block">{{ $category->name }}:</span>
        </div>

        <div class="grid grid-cols-2 md:grid-cols-3 lg:grid-cols-3 w-full max-w-5xl bg-center text-center  lg:gap-8">
            @foreach ($recipes as $recipe)
                <div class="group bg-gray-800 text-white p-8 rounded-lg shadow-xl hover:scale-105 hover:shadow-2xl transition-all ease-in-out duration-300">
                    <a href="{{ route('recipes.show', ['id' => $recipe->id]) }}" class="text-center text-xl font-semibold group-hover:text-yellow-400">
                        {{ $recipe->name }}
                    </a>
                </div>
            @endforeach
        </div>
    </div>
@endsection
