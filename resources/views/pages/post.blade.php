@extends('layout.app')
@section('content')
    @include('components.header')
    @include('components.post')
    @include('components.comments')
    @include('components.comment-form')
    @include('components.footer')
@endsection
