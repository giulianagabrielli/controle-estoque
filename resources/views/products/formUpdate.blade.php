@extends('layouts.app') <!-- pasta layouts, arquivo app -->

@section('content') <!-- conteúdo vai dentro do content em app.blade -->

    <section class="container">
        <h2>Formulário de atualização de produto</h2>

        @if(isset($product)) <!-- informação de produto pelo $id {id} -->
        <form action="/produtos/atualizar" method="POST" enctype="multipart/form-data">
        @csrf
            <!-- input vazio contendo a informação do id do produto para passar pro ProductController -->
            <input type="text" name="idProduct" hidden value="{{$product->id}}">

            <div class="form-group">
                <label for="nameProduct">Nome do Produto</label>
                <input class="form-control" type="text" name="nameProduct" id="nameProduct" value="{{$product->name}}"> 
            </div>
            <div class="form-group">
                <label for="descriptionProduct">Descrição do Produto</label>
                <textarea class="form-control" type="text" name="descriptionProduct" id="descriptionProduct"> {{$product->description}} </textarea>
            </div>
            <div class="form-group">
                <label for="quantityProduct">Quantidade do Produto</label>
                <input class="form-control" type="number" name="quantityProduct" id="quantityProduct" value="{{$product->quantity}}">
            </div>
            <div class="form-group">
                <label for="priceProduct">Preço do Produto</label>
                <input class="form-control" type="number" name="priceProduct" id="priceProduct" value="{{$product->price}}">
            </div>
            <div class="form-group">
                <label for="imgProduct">Imagem do Produto</label>
                <input class="form-control-file" type="file" name="imgProduct" id="imgProduct">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Atualizar informações</button>
            </div>
        </form>
        @elseif(isset($result))

        @else
            <h1>O produto não existe ou id incorreto.</h1>
        @endif

        <div class="row">
            <div class="col-md-12">
                @if(isset($result)) <!-- se existe -->
                    @if($result) <!-- se é verdadeiro ou falso -->
                        <h1>Deu certo!</h1>
                    @else
                        <h1>Não deu certo!</h1>
                    @endif
                @endif

            </div>
        </div>
    
    </section>

@endsection <!-- final da section -->