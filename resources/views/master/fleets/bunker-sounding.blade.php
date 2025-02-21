
@php
    $docs = $fleet->docs()->latest()->paginate(20);
@endphp

<!-- Upload Sounding Table -->
<div class="col-md-12 mt-3 mb-4">
    <div class="card">
        <div class="card-header bg-info justify-content-between">
            <h6 class="mb-0 text-white">Upload Bunker Sounding Table</h6>
            <button id="downloadBunkerTemplate" class="btn btn-success">Download Template</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form id="formUploadBunker" action="{{ route('master.fleets.bunker-sounding.upload', ['id'=>$fleet->id]) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label for="tank_id" class="form-label">Tank : </label>
                            {!! Form::select('tank_id', $tanks, null, ['id' => 'tank_id', 'class' => 'form-control'], [ null => [ "disabled" => true ]]) !!}
                        </div>
                        <div class="mb-3">
                            <label for="file" class="form-label">Upload file (*.xlsx) : </label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>
                        <div class="mb-3 float-end">
                            <button id="submitFormBunker" type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Upload Sounding Table -->

<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-info">
            <h6 class="mb-0 text-white">Bunker Sounding Table</h6>
        </div>
        <div class="card-body">
            <!-- Select Tank -->
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-md-9 d-flex align-items-center justify-content-between gap-2">
                                <span class="text-nowrap">Tank : </span>
                                <select name="search_tank_bunker_id" id="search_tank_bunker_id" class="form-select">
                                    @foreach($tanks as $key => $item)
                                        @if ($key == "")
                                            <option value="{{$key}}" selected disabled>{{$item}}</option>
                                        @else
                                            <option value="{{$key}}">{{$item}}</option>
                                        @endif
                                    @endforeach
                                </select>
                            </div>
                            <div class="col-md-3 d-flex gap-2 justify-content-end">
                                <button type="button" id="viewBunker" class="btn btn-outline-primary">View</button>
                                <button type="button" id="resetBunker" class="btn btn-outline-danger ml-3">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Select Tank -->

            <!-- Table -->
            <table id="soundingBunkerTable" class="table">
                <thead>
                    <tr>
                        <th>Sounding</th>
                        <th>-5</th>
                        <th>-4</th>
                        <th>-3</th>
                        <th>-2</th>
                        <th>-1</th>
                        <th>0</th>
                        <th>1</th>
                        <th>2</th>
                        <th>3</th>
                        <th>4</th>
                        <th>5</th>
                    </tr>
                </thead>
                <tbody>
                    <tr><td colspan="12" class="text-center text-danger"><i>Please Select Tank First!</i></td></tr>
                </tbody>
            </table>
            <!-- End Table -->
        </div>
    </div>
</div>

@push('js_after')
<script>
$(document).ready(function () {
    /** Submit Form **/
    $('#submitFormBunker').on('click', function (e) {
        e.preventDefault();
        if (!(this).hasAttribute('disabled')) {
            $(this).attr('disabled', true);
        }

        $("#formUploadBunker").submit();
    })

    /** View Table Sounding **/
    $('#viewBunker').on('click', function (e) {
        e.preventDefault();

        if (!(this).hasAttribute('disabled')) {
            $(this).attr('disabled', true);
        }

        axios.post("{{ route('master.fleets.bunker-sounding.detail', ['id'=>$fleet->id]) }}", {
            _token: document.head.querySelector('meta[name=csrf-token]').content,
            tank_id: $("#search_tank_bunker_id").val()
        }).then(response => {
            if ((this).hasAttribute('disabled')) {
                $(this).removeAttr('disabled', true);
            }
            
            if (response.data.success) {
                let data = response.data;
                if (data.body.length == 0) {
                    $("#soundingBunkerTable tbody").html('');
                    $("#soundingBunkerTable tbody").append(`<tr><td colspan="12" class="text-center text-danger"><i>No Data Found!</i></td></tr>`);
                }else {
                    /** Set Header **/
                    $("#soundingBunkerTable thead tr").html('');
                    let headers = "";
                    for (let i = 0; i < data.headers.length; i++) {
                        headers += `<th>${data.headers[i]}</th>`;
                    }
    
                    $("#soundingBunkerTable thead tr").append(headers);
    
                    /** Set Body **/
                    $("#soundingBunkerTable tbody").html('');
                    for (let i = 0; i < data.body.length; i++) {
                        let row = "";
                        for (let j = 0; j < data.body[i].length; j++) {
                            row += `<td>${data.body[i][j]}</td>`;
                        }
                        $("#soundingBunkerTable tbody").append(`<tr>${row}</tr>`);
                    }
                }
            }
        }).catch(error => {
            console.log(error)
        });
    })

    /** Reset Table **/
    $('#resetBunker').on('click', function (e) {
        $("#search_tank_bunker_id").val("").change();

        /** Set Header **/
        $("#soundingBunkerTable thead tr").html('');
        let headers = "";
        for (let i = 0; i < ["Sounding", "-5", "-4", "-3", "-2", "-1", "0", "1", "2", "3", "4", "5"].length; i++) {
            headers += `<th>${["Sounding", "-5", "-4", "-3", "-2", "-1", "0", "1", "2", "3", "4", "5"][i]}</th>`;
        }

        $("#soundingBunkerTable thead tr").append(headers);

        /** Set Body **/
        $("#soundingBunkerTable tbody").html('');
        $("#soundingBunkerTable tbody").append(`<tr><td colspan="12" class="text-center text-danger"><i>Please Select Tank First!</i></td></tr>`)
    })

    /** Download Template **/
    $('#downloadBunkerTemplate').on('click', function (e) {
        var a = document.createElement("a");
        a.href = "{{ url('/example/Sambu%20-%20NO.1.F.O.T%20(P).xlsx') }}";
        a.download = "Sambu - NO.1.F.O.T (P).xlsx";
        a.target = "_blank";
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    })
})
</script>
@endpush