<x-admin-app>
    @section('breadcrumb')
        <x-breadcrumb :tree="$tree" current="platforms-setting"></x-breadcrumb>
    @endsection

    <div class="section">
        <button type="button" class="btn btn-primary w-100 arrow-btn collapsed my-2" data-bs-toggle="collapse"
            data-bs-target="#general-setting" aria-expanded="true">
            {{ __('names.general-setting') }}
            <i class="bx bx-sm bx-chevron-left"></i>
        </button>

        <div class="collapse " id="general-setting" style="">
            @if (havePermissionTo('platforms.services.view'))
                <a href="{{ route('admin.settings.platforms.services.index') }}"
                    class="btn btn-primary light w-100 arrow-btn collapsed mb-2">{{ __('names.services-setting') }}</a>
            @endif
            @if (havePermissionTo('platforms.projects.view'))
                <a href="{{ route('admin.settings.platforms.projects.index') }}"
                    class="btn btn-primary light w-100 arrow-btn collapsed mb-2">{{ __('names.projects-setting') }}</a>
            @endif
            @if (havePermissionTo('platforms.news.view'))
                <a href="{{ route('admin.settings.platforms.news.index') }}"
                    class="btn btn-primary light w-100 arrow-btn collapsed mb-2">{{ __('names.news-setting') }}</a>
            @endif
            @if (havePermissionTo('platforms.icons.view'))
                <a href="{{ route('admin.settings.platforms.icons.index') }}"
                    class="btn btn-primary light w-100 arrow-btn collapsed mb-2">{{ __('names.icons-setting') }}</a>
            @endif
            @if (havePermissionTo('platforms.members.view'))
                <a href="{{ route('admin.settings.platforms.members.index') }}"
                    class="btn btn-primary light w-100 arrow-btn collapsed mb-2">{{ __('names.members-setting') }}</a>
            @endif
            @if (havePermissionTo('platforms.banners.view'))
                <a href="{{ route('admin.settings.platforms.banners.index') }}"
                    class="btn btn-primary light w-100 arrow-btn collapsed mb-2">{{ __('names.banners-setting') }}</a>
            @endif
            @if (havePermissionTo('platforms.categories.view'))
                <a href="{{ route('admin.settings.platforms.categories.index') }}"
                    class="btn btn-primary light w-100 arrow-btn collapsed mb-2">{{ __('names.categories-setting') }}</a>
            @endif
            @if (havePermissionTo('platforms.intrenalNews.view'))
                <a href="{{ route('admin.settings.platforms.internal-news.index') }}"
                    class="btn btn-primary light w-100 arrow-btn collapsed mb-2">{{ __('names.internal-news') }}</a>
            @endif
        </div>

        <button type="button" class="btn btn-primary w-100 arrow-btn collapsed my-2" data-bs-toggle="collapse"
            data-bs-target="#website-setting" aria-expanded="false">
            {{ __('names.website-setting') }}
            <i class="bx bx-sm bx-chevron-left"></i>
        </button>
        <div class=" collapse" id="website-setting" style="">
            @if (havePermissionTo('platforms.mainPage.edit'))
                <a href="{{ route('admin.settings.website.main-page') }}"
                    class="btn btn-primary light w-100 arrow-btn collapsed mb-2">{{ __('names.main-page-setting') }}</a>
            @endif
            @if (havePermissionTo('platforms.mainPage.edit'))
                {{-- Change to service page permissions --}}
                <a href="{{ route('admin.settings.website.service-page') }}"
                    class="btn btn-primary light w-100 arrow-btn collapsed mb-2">{{ __('names.service-page-setting') }}</a>
            @endif
            @if (havePermissionTo('platforms.aboutUs.edit'))
                <a href="{{ route('admin.settings.website.about-us') }}"
                    class="btn btn-primary light w-100 arrow-btn collapsed mb-2">
                    {{ __('message.setting', ['model' => __('message.page', ['model' => __('names.about-us')])]) }}
                </a>
            @endif
            {{--            <a href="{{ route('admin.settings.platforms.contact-us') }}" disabled --}}
            {{--               class="btn btn-primary light w-100 arrow-btn collapsed mb-2"> --}}
            {{--                {{ __('message.setting',['model'=>__('message.page',['model'=>__("names.contact-us")])]) }} --}}
            {{--            </a> --}}
            @if (havePermissionTo('platforms.website.reports'))
                <a href="{{ route('admin.settings.website.reports.contact-us') }}"
                    class="btn btn-primary light w-100 arrow-btn collapsed mb-2">
                    {{ __('names.reports') }}
                </a>
            @endif
            @if (havePermissionTo('platforms.website.settings'))
                <a href="{{ route('admin.settings.website.setting') }}"
                    class="btn btn-primary light w-100 arrow-btn collapsed mb-2">
                    {{ __('names.footer-header-setting') }}
                </a>
            @endif
        </div>
        {{--        <button type="button" class="btn btn-primary w-100 arrow-btn collapsed my-2" data-bs-toggle="collapse" --}}
        {{--                data-bs-target="#application-setting" aria-expanded="false"> --}}
        {{--            {{ __('names.application-setting') }} --}}
        {{--            <i class="bx bx-sm bx-chevron-left"></i> --}}
        {{--        </button> --}}
        {{--        <div class=" collapse" id="application-setting" style=""> --}}
        {{--            <a href="{{ route('admin.settings.platforms.projects.index') }}" --}}
        {{--               class="btn btn-primary light w-100 arrow-btn collapsed mb-2"> --}}
        {{--                {{ __('names.main-page-setting') }} --}}
        {{--                <i class="bx bx-sm bx-chevron-left"></i> --}}
        {{--            </a> --}}
        {{--        </div> --}}
    </div>

</x-admin-app>
