@extends('admin.layouts.app')
@section('title') {{ __('Edit Broker') }}
@stop
@section('head_content')
@include('admin.brokers.head')
@stop
@section('content')
@include('admin.errors.errors')
@include('admin.layouts.forms.edit',['table'=>'brokers','model'=>$broker])
@include('admin.brokers.form')
@include('admin.layouts.forms.close')
@stop
@section('after_foot')
@include('admin.layouts.image')
@stop

