@extends('admin.layouts.app')
@section('title') {{ __('names.client-data') }}
@stop
@section('head_content')
@include('admin.clients.head')
@stop
@section('content')
@include('admin.errors.errors')
<section>
    <h4>تعديل عميل</h4>
@include('admin.layouts.forms.edit',['table'=>'clients','enctype' => true,'model'=>$client])
@include('admin.clients.form')
@include('admin.layouts.forms.close')
</section>
@stop
@section('after_foot')
@include('admin.layouts.image')
@stop

