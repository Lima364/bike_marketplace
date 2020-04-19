@extends('layouts.app')


@section('content')
    <h1>Atualizar Produto</h1>

    <form action="{{route('admin.products.update', ['product' => $product->id])}}" method="post">
        @csrf
        @method("PUT")

        <div class="form-group">
            <label>Nome Produto</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" value="{{$product->name}}">

            @error('name')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Descrição</label>
            <input type="text" name="description" class="form-control @error('description') is-invalid @enderror" value="{{$product->description}}">

            @error('description')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Conteúdo</label>
            <textarea name="body" id="" cols="30" rows="10" class="form-control @error('body') is-invalid @enderror">{{$product->body}}</textarea>

            @error('body')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>


        <div class="form-group">
            <label>Preço</label>
            <input type="text" name="price" class="form-control @error('price') is-invalid @enderror" value="{{$product->price}}">

            @error('price')
            <div class="invalid-feedback">
                {{$message}}
            </div>
            @enderror
        </div>

        <div class="form-group">
            <label>Slug</label>
            <input type="text" name="slug" class="form-control" value="{{$product->slug}}">
        </div>

        <div>
            <button type="submit" class="btn btn-lg btn-success">Atualizar Produto</button>
        </div>
    </form>
@endsection 





<!-- @extends('layouts.app')

@section('content')
<h1>Atualizar Produto</h1>

<form action="{{route('admin.products.update', ['product'=>$product->id])}}" method="post">
    @csrf
    @method("PUT")

    <div class="form-group">
        <label>Nome Produto</label>
        <input type="text" name="name" class="form-control" value="{{$product->name}}">
    </div>

    <div class="form-group">
        <label>Descrição</label>
        <input type="text" name="description" class="form-control" value="{{$product->description}}">
    </div>

    <div class="form-group">
        <label>Conteúdo</label>
        <textarea name="body" id="" cols="30" rows="10" class="form-control">{{$product->body}}</textarea>
      esta linha já estava comentada antes de comentar o resto do código  <input type="text" name="description" class="form-control">
    </div>

    <div class="form-group">
        <label>Preço</label>
        <input type="text" name="price" class="form-control" value="{{$product->price}}">
    </div>


    <div class="form-group">
        <label>Slug</label>
        <input type="text" name="slug" class="form-control" value="{{$product->slug}}">
    </div>

    <div>
        <button type="submit" class="btn btn-lg btn-success">Atualizar Produto</button>
    </div>

</form>
@endsection -->

<!-- <input type="hidden" name="_token" value="{{csrf_token()}}"> // substituida esta linha por @csrf -->
<!-- <input type="hidden" name="_method" value="PUT"> // substituida por @method -->
<!-- ambas estavam associadas na  -->
<!-- <form action="{{route('admin.products.update', ['product'=>$product->id])}}" method="post"> -->
