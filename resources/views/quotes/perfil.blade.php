@extends('layouts.app')
@section('content')
    <perfil-index :perfil="{{ json_encode($perfil) }}"></perfil-index>
@endsection