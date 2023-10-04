<div class="row">
    <div class="col-sm-6">
        @include('admin.layouts.forms.fields.text', [
            'label_show' => 'yes',
            'placeholder' => __('Employee Name'),
        ])

    </div>
</div>
@include('admin.layouts.forms.buttons.form-save')
