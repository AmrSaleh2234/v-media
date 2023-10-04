<div class="nav nav-tabs mt-2 static-4" id="myTab" role="tablist">

    @if (havePermissionTo('platforms.projects.view'))
        <a class="mx-1  @if (isset($class) && $class == 'project') active @endif"
            @if (isset($class) && $class == 'project') href="#content-03" id="tab-03" data-toggle="tab" role="tab"
       aria-controls="content-03" aria-selected="true"
       @else
           href="{{ route('admin.settings.platforms.projects.index') }}" @endif>
            {{ __('names.projects') }}
        </a>
    @endif
    @if (havePermissionTo('platforms.projectTypes.view'))
        <a class=" mx-1 @if (isset($class) && $class == 'project_type') active @endif"
            @if (isset($class) && $class == 'project_type') href="#content-04" id="tab-4" data-toggle="tab" role="tab"
       aria-controls="content-04" aria-selected="true"
       @else
           href="{{ route('admin.settings.platforms.projects_types.index') }}" @endif>
            {{ __('names.project-types') }}
        </a>
    @endif
</div>
