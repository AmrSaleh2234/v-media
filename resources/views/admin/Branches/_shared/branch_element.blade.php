  <button type="button" class="btn btn-primary {{ $light ?? '' }} w-100 arrow-btn collapsed my-2">
      {{ $branch->name }}

      <div>
          <i data-bs-toggle="collapse" data-bs-target="#show-{{ $branch->id }}" aria-expanded="true"
              class="bx bx-sm bx-show"></i>
          @if (count($branch->childern) >= 1)
              <i data-bs-toggle="collapse" data-bs-target="#childern-{{ $branch->id }}" aria-expanded="true"
                  class="bx bx-sm bx-plus-circle"></i>
          @endif
      </div>

  </button>
  <div class="collapse mt-2 mb-2" id="show-{{ $branch->id }}">
      <x-table :responsive="true">

          <thead>

              <th>
                  {{ __('names.id') }}
              </th>
              <th>
                  {{ __('names.branch-name') }}
              </th>
              <th>
                  {{ __('names.branch-type') }}
              </th>
              <th>
                  {{ __('names.location') }}
              </th>
              <th>
                  {{ __('message.manager', ['model' => __('names.branch')]) }}
              </th>
              <th>
                  {{ __('names.phone') }}
              </th>
              <th>
                  {{ __('names.email') }}
              </th>
              <th>
                  {{ __('names.setting') }}
              </th>
          </thead>
          <tbody>
              <tr>
                  <td>{{ $branch->id }}</td>
                  <td><a href="{{ route('admin.branches.edit', $branch->id) }}">{{ $branch->name }}</a></td>
                  <td>{{ __('names.' . $branch->type) }}</td>
                  <td>{{ optional($branch->city)->name }}</td>
                  <td>{{ $branch->manager?->name }}</td>
                  <td>{{ $branch->phone }}</td>
                  <td>{{ $branch->email }}</td>
                  <td>
                      <div class=" limit-2">
                          @if (havePermissionTo('branches.edit'))
                              <a href="{{ route('admin.branches.edit', $branch->id) }}" class="px-1">
                                  <i class='bx bxs-edit bx-sm text-gray'></i>
                              </a>
                          @endif
                          @if (havePermissionTo('branches.delete'))
                              <a href="#" class="px-1" wire:click.prevent="delete({{ $branch->id }})">
                                  <i class='bx bx-trash bx-sm text-danger'></i>
                              </a>
                          @endif
                      </div>
                  </td>
              </tr>
          </tbody>
      </x-table>
  </div>
