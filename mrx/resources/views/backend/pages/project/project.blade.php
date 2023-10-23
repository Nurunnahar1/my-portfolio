@extends('backend.layout.sidenav-layout')
@section('content')

    @include('backend.components.project.index')
    @include('backend.components.project.create')
    @include('backend.components.project.update')
    @include('backend.components.project.delete')
@endsection
 
