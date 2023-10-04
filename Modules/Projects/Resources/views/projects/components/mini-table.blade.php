<x-table :responsive="false">
<thead>
    <tr>
        <th scope="col">{{ __('projects::names.project-number') }}</th>
        <th scope="col">{{ __('projects::names.incoming-date') }}</th>
        <th scope="col">{{ __('projects::names.client-name') }}</th>
        <th scope="col">{{ __('projects::names.project-name') }}</th>
        <th scope="col">{{ __('projects::names.project-type') }}</th>
        <th scope="col">{{ __('projects::names.current-status') }}</th>
        <th scope="col">{{ __('projects::names.pre-status') }}</th>
        <th scope="col">{{ __('projects::names.file') }}</th>
    </tr>
</thead>
<tbody>
@forelse ($projects as $key => $project)
<tr>
    <td> <div class="limit-8"> <a href="{{ route('admin.projects.show',$project->id) }}">{{ $project->number }}</a></div></td>
    <td> <div class="limit-8"> {{ $project->created }}</div></td>
    <td> <div class="limit-8"> {{ optional($project->client)->name }}</div></td>
    <td> <div class="limit-8"> {{ optional($project)->name }}</div></td>
    <td> <div class="limit-8"> {{ $project->type }}</div></td>
    <td> <div class="limit-8"> {{ optional($project->status)->name }}</div></td>
    <td> <div class="limit-8"> {{ optional($project->status)->name }}</div></td>
    <td> <div class="limit-8"> <i class="icon-folder-open"></i>
    </div></td>
</tr>
@empty
    <td colspan="10">
        <div class="">
            <img class="" style="height: 100%" src="{{ asset('assets/images/empty.png') }}" alt="">

        </div>
        {{ __('message.empty',['model'=>__('names.projects')]) }}
    </td>
@endforelse
</tbody>
</x-table>
