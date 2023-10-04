


<li class="mb-1">
    <button
        class="btn btn-toggle btn-icon align-items-center rounded collapsed px-1 fw-semibold py-2"
        data-bs-toggle="collapse"
        data-bs-target="#orders-collapse"
        aria-expanded="false"
    >
        <i class="bx bx-sm bx-chevron-left"></i>
        <span class="btn-icon">
            <i class='bx bx-sitemap bx-sm'></i>
              {{ __('names.projects-management') }}
        </span>
    </button>
    <div class="collapse" id="orders-collapse">
        <ul class="btn-toggle-nav list-unstyled fw-normal pb-1 small">
            <li class="mb-1 px-1">
                <a href="{{ route('admin.projects.index') }}"  class="rounded">{{ __('names.projects') }}</a>
            </li>
            <li class="mb-1 px-1">
                <a href="{{ route('admin.contracts.index') }}"  class="rounded">{{ __('names.contracts') }}</a>
            </li>
            <li class="mb-1 px-1">
                <a href="{{ route('admin.contracts.index') }}"  class="rounded">{{ __('names.contract-forms') }}</a>
            </li>
        </ul>
    </div>
</li>
