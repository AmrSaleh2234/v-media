<div class="nav nav-tabs mt-2 static-4" id="myTab" role="tablist">
{{--    @if (havePermissionTo('platforms.settings.reports.contactUs'))--}}
        <a class=" mx-1 @if (isset($class) && $class == 'contact_us') active @endif" disabled="disabled"
           @if (isset($class) && $class == 'contact_us') href="#content-04" id="tab-4" data-toggle="tab" role="tab"
           aria-controls="content-04" aria-selected="true"
           @else
               href="{{ route('admin.settings.website.reports.contact-us') }}" @endif>
            {{ __('names.contact-us-requests') }}
        </a>
{{--    @endif--}}
{{--    @if (havePermissionTo('platforms.settings.reports.services'))--}}
        <a class="mx-1  @if (isset($class) && $class == 'services') active @endif"
           @if (isset($class) && $class == 'services') href="#content-03" id="tab-03" data-toggle="tab" role="tab"
           aria-controls="content-03" aria-selected="true"
           @else
               href="{{ route('admin.settings.website.reports.services') }}" @endif>
            {{ __('names.services-requests') }}
        </a>
{{--    @endif--}}
{{--    @if (havePermissionTo('platforms.settings.reports.subscribers'))--}}
        <a class=" mx-1 @if (isset($class) && $class == 'subscribers') active @endif"
           @if (isset($class) && $class == 'subscribers') href="#content-01" id="tab-1" data-toggle="tab" role="tab"
           aria-controls="content-04" aria-selected="true"
           @else
               href="{{ route('admin.settings.website.reports.subscribers') }}" @endif>
            {{ __('names.subscribers') }}
        </a>
{{--    @endif--}}
</div>
