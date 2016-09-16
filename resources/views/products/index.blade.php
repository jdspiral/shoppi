@extends('layouts.master')

@section('title', 'Page Title')

@section('content')
    <p>Visit the products endpoint <a href="/api/v1/products">/api/v1/products</a></p>
    {!! Form::open(['action' => 'Web\ProductsController@store']) !!}
    <div class="form-group">
        {!! Form::label('name', 'Title', ['class' => 'control-label']) !!}
        {!! Form::text('name', '', ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('description', 'Description') !!}
        {!! Form::text('description', '', ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::label('price', 'Price') !!}
        {!! Form::number('price', '', ['class' => 'form-control']) !!}
    </div>
    <div class="form-group">
        {!! Form::submit('Click Me!') !!}
        {!! Form::close() !!}
    </div>
    <hr/>
    @foreach ($products as $product)
        <p>This is product is {{ $product->name }}</p>
    @endforeach
@endsection