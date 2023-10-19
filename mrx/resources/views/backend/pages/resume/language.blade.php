@extends('backend.layout.sidenav-layout')
@section('content')
    @include('backend.components.languages.index')
    @include('backend.components.languages.create')
    @include('backend.components.languages.update')
    @include('backend.components.languages.delete')
@endsection
