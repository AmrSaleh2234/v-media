<div id="work-domain-container_{{ $i }}" class="collapseIt">
    <div class="work-domain-container">
      <div class="def-card" style="margin-bottom:.4em;">
        <div class="name">
            {{ __('projects::names.main-item') }} / {{ $item['main_item_title'] }}
        </div>
        <button
          type="button"
          id="add-new-project-item-popup-button"
          class="default add-button"
        >
          <i class="icon"></i>
        </button>
      </div>
    </div>
    <div class="sub-items-table-container mb-4">
      <table class="sub-items-table">
        <thead>
            <th  >
                {{ __('projects::names.sub-items') }}
            </th>
            <th  >
                {{ __('projects::names.amount') }}
            </th>
            <th  >
                {{ __('projects::names.duration') }}
            </th>
        </thead>
        <tbody>
            @foreach ($item['subItems'] as $subItem)
                    <tr>
                        <td>
                            {{ $subItem['sub_item_title'] }}
                        </td>
                        <td>
                            {{ $subItem['sub_item_amount'] }}
                        </td>
                        <td>
                            {{ $subItem['sub_item_period'] }}
                        </td>
                    </tr>
            @endforeach
        </tbody>

      </table>
      {{-- <script>
        {
            console.log('{{ $i }}');
          const container = document.getElementById(
            "work-domain-container_{{ $i }}"
          );
          const cardToClick =
            container.getElementsByClassName("def-card")[0];
          const tableContainer = container.getElementsByClassName(
            "sub-items-table-container"
          )[0];
          cardToClick.addEventListener("click", () => {
            const condition =
              tableContainer.classList.contains("hidden");
            if (condition) {
              tableContainer.classList.remove("hidden");
            } else {
              tableContainer.classList.add("hidden");
            }
          });
        }
      </script> --}}
    </div>
  </div>
