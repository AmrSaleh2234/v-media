@if (count($errors) > 0)
<div class="alert alert-danger alert-dismissible">
    <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
    <h4><i class="icon fa fa-ban"></i>@foreach ($errors->all() as $error) {{ $error }}<br> @endforeach</h4>
</div>
@endif
