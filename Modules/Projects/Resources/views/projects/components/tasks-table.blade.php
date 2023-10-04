<div class="table-container">
    <table>
        <thead>
        <tr>
            <th scope="col">{{ __('projects::names.item-name') }}</th>
            <th scope="col">{{ __('projects::names.duration') }}</th>
            <th scope="col">{{ __('projects::names.item-status') }}</th>
            <th scope="col">{{ __('projects::names.responsible-engineer') }}</th>
            <th scope="col">{{ __('projects::names.expected-date') }}</th>
            <th scope="col">{{ __('projects::names.actual-date') }}</th>
            <th scope="col">{{ __('names.branch') }}</th>
            <th scope="col">{{ __('projects::names.access') }}</th>
            <th scope="col">{{ __('projects::names.tasks') }}</th>
        </tr>
        </thead>
        <tbody>
        @forelse ($tasks as $key => $task)
            <tr>
                <td>{{ $task->name }}</td>
                <td>{{ $task->duration . __('names.day') }} </td>
                <td>{{ __('projects::names.'.optional($task->status)->name) }}</td>
                <td>
                    @forelse( $task->users as $user)
                        {{ optional($user)->name }}
                    @empty
                        {{ __('projects::names.not-assign') }}
                    @endforelse</td>
                <td>{{ $task->expected }}</td>
                <td>{{ $task->actual }}</td>
                <td>{{ optional($task->branch)->name }}</td>
                <td><i class="icon-folder-open"></i></td>
                <td><i class="icon-folder-open"></i></td>
            </tr>
        @empty
            <tr>
                <td colspan="10">
                    <div class="">
                        <img class="" style="height: 100%" src="{{ asset('assets/images/empty.png') }}" alt="">

                    </div>
                    {{ __('message.empty',['model'=>__('names.projects')]) }}
                </td>
            </tr>
        @endforelse

        </tbody>
    </table>
</div>
