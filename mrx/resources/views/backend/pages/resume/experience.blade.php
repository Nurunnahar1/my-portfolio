@extends('backend.layout.sidenav-layout')
@section('content')
    @include('backend.components.experience.index')
    @include('backend.components.experience.create')
    @include('backend.components.experience.update')
    @include('backend.components.experience.delete')
@endsection
