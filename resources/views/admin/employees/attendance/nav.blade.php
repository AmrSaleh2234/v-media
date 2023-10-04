<div class="nav nav-tabs mt-2 static-4" id="myTab" role="tablist">

    @if (havePermissionTo('jobTypes.view'))
        <a class="mx-1  @if (isset($class) && $class == 'job_type') active @endif"
            @if (isset($class) && $class == 'job_type') href="#content-03" id="tab-03" data-toggle="tab"  role="tab"
           aria-controls="content-03" aria-selected="true"
           @else
               href="{{ route('admin.job_types.index') }}" @endif>
            {{ __('names.job-type') }}
        </a>
    @endif

    @if (havePermissionTo('jobNames.view'))
        <a class=" mx-1 @if (isset($class) && $class == 'job_name') active @endif"
            @if (isset($class) && $class == 'job_name') href="#content-04" id="tab-4" data-toggle="tab"  role="tab"
           aria-controls="content-04" aria-selected="true"
           @else
               href="{{ route('admin.job_names.index') }}" @endif>
            {{ __('names.job-name') }}
        </a>
    @endif

    @if (havePermissionTo('jobGrades.view'))
        <a class="mx-1  @if (isset($class) && $class == 'job_grade') active @endif"
            @if (isset($class) && $class == 'job_grade') href="#content-05" id="tab-05" data-toggle="tab" role="tab"
           aria-controls="content-05" aria-selected="true"
           @else
               href="{{ route('admin.job_grades.index') }}" @endif>
            {{ __('names.job-grade') }}
        </a>
    @endif
</div>
