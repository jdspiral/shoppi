@extends('layouts.master')

@section('title', 'Page Title')

@section('content')
    <p>Visit the products endpoint <a href="/api/v1/products">/api/v1/products</a></p>
    {!! Form::open(['action' => 'Web\ProductsController@store']) !!}
    {!! Form::label('name', 'Title') !!}
    {!! Form::text('name') !!}
    {!! Form::label('description', 'Description') !!}
    {!! Form::text('description') !!}
    {!! Form::label('price', 'Price') !!}
    {!! Form::number('price') !!}
    {!! Form::submit('Click Me!') !!}
    {!! Form::close() !!}
    <hr/>
    @foreach ($products as $product)
        <p>This is product is {{ $product->name }}</p>
    @endforeach
@endsection