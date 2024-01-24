@extends('app')

@section('content')
    <div class="container w-25 border p-4 mt-4">
        <form action="{{ route('categories.store') }}" method="POST">
            @csrf {{-- Cross Site Request Forgery --}}
            {{-- On success --}}
            @if (session('success'))
                <div class="alert alert-success">
                    {{ session('success') }}
                </div>
            @endif

            @error('title')
                <div class="alert alert-danger">
                    {{ $message }}
                </div>
            @enderror

            <div class="mb-3">
                <label for="title" class="form-label">Nombre de la categoria</label>
                <input type="text" name="name" class="form-control" id="name">
            </div>
            <div class="mb-3">
                <label for="title" class="form-label">Color de la categoria</label>
                <input type="color" name="color" class="form-control" id="color">
            </div>

            <button type="submit" class="btn btn-primary">Crear nueva categoria</button>
        </form>
        <div>
            @foreach ($categories as $category)
                <div class="row py-1">
                    <div class="col-md-9 d-flex align-items-center">
                        <span class="color-container"
                            style="background-color: {{ $category->color }}; margin-right: 8px"></span>
                        <a href="{{ route('categories.index', ['id' => $category->id]) }}">
                            {{ $category->name }}
                        </a>
                    </div>
                    <div class="col-md-3 d-flex justify-content-end">
                        <button class="btn btn-danger btn-sm" data-bs-toggle="modal"
                            data-bs-target="#deleteModal-{{ $category->id }}">Eliminar</button>

                    </div>
                </div>
        </div>
        <div class="modal fade" id="deleteModal-{{ $category->id }}" tabindex="-1" aria-labelledby="deleteModalLabel"
            aria-hidden="true">
            <div class="modal-dialog">
                <div class="modal-content">
                    <div class="modal-header">
                        <h1 class="modal-title fs-5" id="deleteModalLabel">Eliminar categoria</h1>
                        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                    </div>
                    <div class="modal-body">
                        ¿Estas seguro de eliminar la categoria {{ $category->name }}? Al eliminar la categoria se eliminaran
                        todas sus tareas asociadas
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancelar</button>
                        <form action="{{ route('categories.destroy', [$category->id]) }}" method="POST">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="btn btn-danger">Eliminar</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
        @endforeach

    </div>

    </div>
    </div>
@endsection
