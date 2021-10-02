@extends('adminlte::page')
@section('cabecalho')

@foreach($data as $d)
  {{ $d->id }}
@endforeach
            
@endsection