@extends('backend.layout.sidenav-layout')
@section('content')
    @include('backend.components.education.index')
    @include('backend.components.education.create')
    @include('backend.components.education.update')
    @include('backend.components.education.delete')
@endsection
