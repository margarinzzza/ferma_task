@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row add_from">
            <div class="col-md-6">
                <div class="">
                    <h2>Добавить обьект</h2>
                    <form class="d-flex flex-column" method="POST" enctype="multipart/form-data"
                        action="{{ route('add_object') }}">
                        @csrf
                        <input class="form-control" type="text" name="name" placeholder="Название"required>
                        <select class="form-control" name="category" required>
                            @foreach ($categories as $category)
                                <option value="{{ $category['name'] }}">{{ $category['name'] }}</option>
                            @endforeach
                        </select>
                        <input class="form-control" type="file" name="image" required>
                        <input class="form-control" type="submit" value="Добавить">
                    </form>
                </div>
            </div>
            <div class="col-md-6">
                <div class="">
                    <h2>Добавить категорию</h2>
                    <form class="d-flex flex-column" method="POST" enctype="multipart/form-data"
                        action="{{ route('add_category') }}">
                        @csrf
                        <input class="form-control" type="text" name="name" placeholder="Название" required>
                        <input class="form-control" type="submit" value="Добавить">
                    </form>
                </div>
                <div>
                    <h3>Список категорий:</h3>
                    <ul>
                        @foreach ($categories as $category)
                            <li>{{ $category['name'] }} | <a href="delete_category/{{ $category['id'] }}">Удалить</a>
                            </li>
                        @endforeach
                    </ul>
                </div>
            </div>
        </div>
        <div class="row object_list">
            <h2>Список обьектов: </h2>
            @foreach ($objects as $object)
                <div class="col-md-4 d-flex flex-column">
                    <div class="d-flex justify-content-center">
                        <img class="w-100" src="../../storage/app/{{ $object['img'] }}" alt="">
                    </div>
                    <span>Дата создания: {{ $object['created_at'] }}</span>
                    <span>Название: {{ $object['name'] }}</span>
                    <span>Категория: {{ $object['category'] }}</span>
                    <div class="d-flex justify-content-evenly">
                        <a class="form-control" href="delete_object/{{ $object['id'] }}">Удалить</a>
                        <a class="form-control" href="redact_object_page/{{ $object['id'] }}">Редактировать</a>
                    </div>
                </div>
            @endforeach
        </div>
    </div>
@endsection
