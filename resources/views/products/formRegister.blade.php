@extends('layouts.app') <!-- pasta layouts, arquivo app -->

@section('content') <!-- conteúdo vai dentro do content em app.blade -->

    <section class="container">
        <h2>Formulário de cadastro de produto</h2>
        <form action="/produtos/cadastrar" method="POST" enctype="multipart/form-data">
        @csrf
            <div class="form-group">
                <label for="nameProduct">Nome do Produto</label>
                <input class="form-control" type="text" name="nameProduct" id="nameProduct">
            </div>
            <div class="form-group">
                <label for="descriptionProduct">Descrição do Produto</label>
                <textarea class="form-control" type="text" name="descriptionProduct" id="descriptionProduct"></textarea>
            </div>
            <div class="form-group">
                <label for="quantityProduct">Quantidade do Produto</label>
                <input class="form-control" type="number" name="quantityProduct" id="quantityProduct">
            </div>
            <div class="form-group">
                <label for="priceProduct">Preço do Produto</label>
                <input class="form-control" type="number" name="priceProduct" id="priceProduct">
            </div>
            <div class="form-group">
                <label for="imgProduct">Imagem do Produto</label>
                <input class="form-control-file" type="file" name="imgProduct" id="imgProduct">
            </div>
            <div class="form-group">
                <button class="btn btn-primary" type="submit">Cadastrar</button>
            </div>
        </form>

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