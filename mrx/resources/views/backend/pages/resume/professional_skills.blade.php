@extends('backend.layout.sidenav-layout')
@section('content')
    @include('backend.components.professional_skills.index')
    @include('backend.components.professional_skills.create')
    @include('backend.components.professional_skills.update')
    @include('backend.components.professional_skills.delete')
@endsection
