@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row d-flex justify-content-center">
            <div class="col-md-7 d-flex justify-content-center">
                <form action="{{ route('redact_object', $object['id']) }}" enctype="multipart/form-data" method="POST" class="w-100">
                    @csrf
                    <div class="d-flex justify-content-center">
                        <img src="../../storage/app/{{ $object['img'] }}" alt="">
                    </div>
                    <input class="form-control my-3" type="text" value="{{ $object['name'] }}" name="name">
                    <select class="form-control" name="category">
                        @foreach ($categories as $category)
                            <option value="{{ $category['name'] }}">{{ $category['name'] }}</option>
                        @endforeach
                    </select>
                    <input class="form-control my-3" type="file" name="image">
                    <input class="form-control" type="submit" value="Редактировать">
                </form>
            </div>

        </div>
    </div>
@endsection
