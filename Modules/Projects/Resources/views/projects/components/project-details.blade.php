<div class="page-content">

    <div class="section-navbar">
        <div class="item active"><a href="">{{ __('projects::names.project-details') }}</a></div>
        <div class="item"><a href="">{{ __('projects::names.items') }}</a></div>
        <div class="item"><a href="">{{ __('projects::names.attachments') }}</a></div>
        <div class="item"><a href="">{{ __('projects::names.appointments') }}</a></div>
        <div class="item"><a href="">{{ __('projects::names.reports') }}</a></div>
        <div class="item"><a href="">{{ __('projects::names.finance') }}</a></div>
        <div class="item"><a href="">{{ __('projects::names.movement-log') }}</a></div>
        <div class="item"><a href="">{{ __('projects::names.requests') }}</a></div>
        <div class="item"><a href="">{{ __('projects::names.workspace') }}</a></div>

    </div>
    <div class="project-info-reciept">
        <div class="data-item">
            <h4>{{ __('projects::names.client-name') }}</h4>
            <p>{{ optional($project->client)->name }}</p>
        </div>
        <div class="data-item">
            <h4>{{ __('projects::names.contract-number') }}</h4>
            <p>{{ optional($project->contract)->number }}</p>
        </div>
        <div class="data-item">
            <h4>{{ __('projects::names.project') }}</h4>
            <p>{{ $project->name }}</p>
        </div>
        <div class="data-item">
            <h4>{{ __('projects::names.location-details') }}</h4>
            <p>{{ $project->location }}</p>
        </div>
        <div class="data-item">
            <h4>{{ __('projects::names.start-date') }}</h4>
            <p>{{ $project->startAt }}</p>
        </div>
        <div class="data-item">
            <h4>{{ __('projects::names.end-date') }}</h4>
            <p>{{ $project->end_date ?? $project->expectedAt }}</p>
        </div>
        <div class="data-item">
            <h4>{{ __('projects::names.responsible-engineer') }}</h4>
            <p>{{ optional($project->responsible)->name }}</p>
        </div>
        <div class="print-container">
            <button>طباعة</button>
        </div>
    </div>
</div>
