<div class="col-md-12 mt-3 mb-4">
  <div class="card">
      <div class="card-header bg-info justify-content-between">
          <h6 class="mb-0 text-white">Cargo Tank</h6>
          <button id="saveCargoTank" class="btn btn-primary">Save</button>
      </div>
      <div class="card-body">
          <div class="row">
              <div class="col-md-12">
                <table id="cargoTankTable" class="table">
                    <thead>
                        <tr>
                            <th>Name Tank</th>
                            <th>Content Type</th>
                        </tr>
                    </thead>
                    <tbody>
                        @if (isset($cargoTanks) && !empty($cargoTanks))
                            @foreach($cargoTanks as $key => $item)
                                <tr>
                                    <td>{{ $item->tank_position?? '-' }}</td>
                                    <td>
                                        <select class="selectContentType form-control" data-id="{{$item->id}}" name="content_type" id="content_type_{{$item->id}}">
                                            <option value="" selected disabled>Select Content Type</option>
                                            @if (is_array($cargoDensities) && !empty($cargoDensities))
                                                @foreach($cargoDensities as $index => $option)
                                                    <option value="{{$index}}" {{ $item->content_type == $index ? 'selected' : '' }}>{{$option}}</option>
                                                @endforeach
                                            @endif
                                        </select>
                                    </td>
                                </tr>
                            @endforeach
                        @else
                            <tr><td colspan="2" class="text-center text-danger"><i>No Data Found!</i></td></tr>
                        @endif
                    </tbody>
                </table>
              </div>
          </div>
      </div>
  </div>
</div>

@push('js_after')
<script>
$(document).ready(function () {
    resetLocalStorage()

    function resetLocalStorage() {
        if (localStorage.getItem("formCargoTank") !== null) {
            localStorage.removeItem("formCargoTank");
        }
    }

    $('.selectContentType').on('change', function (e) {
        var storedData = JSON.parse(localStorage.getItem("formCargoTank")) || [];

        if (!Array.isArray(storedData)) {
            storedData = [];
        }

        storedData.push({
            'id': $(this).attr('data-id'),
            'content_type': $(this).val()
        });

        localStorage.setItem("formCargoTank", JSON.stringify(storedData));
    })

    /** Submit Form **/
    $('#saveCargoTank').on('click', function (e) {
        e.preventDefault();

        if (!(this).hasAttribute('disabled')) {
            $(this).attr('disabled', true);
        }

        axios.post("{{ route('master.fleets.cargo-tank.submit', ['id'=>$fleet->id]) }}", {
            _token: document.head.querySelector('meta[name=csrf-token]').content,
            data: JSON.parse(localStorage.getItem("formCargoTank"))
        }).then(response => {
            if ((this).hasAttribute('disabled')) {
                $(this).removeAttr('disabled', true);
            }
            
            if (response.data.success) {
                window.location.href = "{{ route('master.fleets.show', ['fleet'=>$fleet->id]) }}"
            }else {
                console.log(response)
            }
        }).catch(error => {
            console.log(error)
        });
    })
})
</script>
@endpush