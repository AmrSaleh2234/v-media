<div class="table-container">
    <table>
<thead>
    <tr>
        <th scope="col">{{ __('projects::names.file-name') }}</th>
        <th scope="col">{{ __('projects::names.type') }}</th>
        <th scope="col">{{ __('projects::names.size') }}</th>
        <th scope="col">{{ __('projects::names.creator') }}</th>
        <th scope="col">{{ __('projects::names.created-at') }}</th>
        <th scope="col">{{ __('projects::names.setting') }}</th>
        <th scope="col">{{ __('projects::names.access') }}</th>
    </tr>
</thead>
<tbody>
@forelse ($attachments as $key => $attachment)
<tr>
    <td>{{ $attachment->name }}</td>
    <td>{{ $attachment->type }}</td>
    <td>{{ $attachment->size  }} </td>
    <td>{{ optional($attachment->user)->name }}</td>
    <td>{{ $item->created }}</td>
    <td><i class="icon-folder-open"></i>
        <i class="icon-folder-open"></i></td>
    <td><a href="#"><i class="icon-folder-open"></i></a>/td>
</tr>
@empty
    <tr> <td colspan="7"> {{ __('projects::messages.no-attachments-yet') }}</td></tr>
@endforelse
</tbody>
</table>
</div>
