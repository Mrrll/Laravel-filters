@extends('layouts.plantilla')

@section('title', 'Tag')

@section('content')
    <main class="container-fluid ">
        <div class="d-flex justify-content-between mt-2">
            <h4>Tags</h4>
            <div class="d-flex">
                <x-dom.button class="btn btn-primary me-2" type="modal" route="tag">
                    @lang('Create')
                </x-dom.button>
                <x-dom.button class="btn btn-secondary" type="link" route="movies.index">
                    @lang('Back')
                </x-dom.button>
            </div>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th>#</th>
                    <th class="w-75">Name</th>
                    <th>Options</th>
                </tr>
            </thead>
            <tbody>
                @forelse ($tags as $tag)
                    <tr>
                        <td>{{ $tag->id }}</td>
                        <td class="w-75">{{ $tag->name }}</td>
                        <td>
                           <x-dom.form action="{{ route('tags.destroy', $tag) }}" method="DELETE"
                                valid="{{ false }}">
                                <x-dom.button class="btn-outline-danger" type="submit">
                                    <i class="fa-solid fa-trash fa-xl"></i>
                                </x-dom.button>
                            </x-dom.form>
                        </td>
                    </tr>
                @empty
                    <tr>
                        <td colspan="3">
                            @lang('There are no records')
                        </td>
                    </tr>
                @endforelse
            </tbody>
        </table>
        <div class="d-flex justify-content-center">
            {{ $tags->links() }}
        </div>
    </main>
@endsection
