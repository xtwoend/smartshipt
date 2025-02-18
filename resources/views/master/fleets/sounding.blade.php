
@php
    $docs = $fleet->docs()->latest()->paginate(20);
@endphp

<!-- Upload Sounding Table -->
<div class="col-md-12 mt-3 mb-4">
    <div class="card">
        <div class="card-header bg-info justify-content-between">
            <h6 class="mb-0 text-white">Upload Sounding Table</h6>
            <button id="downloadTemplate" class="btn btn-success">Download Template</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form action="{{ route('master.fleets.sounding.upload', ['id'=>$fleet->id]) }}" method="POST" enctype="multipart/form-data">
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
                            <button type="submit" class="btn btn-primary">Upload</button>
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
            <h6 class="mb-0 text-white">Sounding Table</h6>
        </div>
        <div class="card-body">
            <!-- Select Tank -->
            <div class="col-md-12 mb-3">
                <div class="card">
                    <div class="card-body">
                        <div class="row align-items-center justify-content-between">
                            <div class="col-md-9 d-flex align-items-center justify-content-between gap-2">
                                <span class="text-nowrap">Tank : </span>
                                <select name="search_tank_id" id="search_tank_id" class="form-select">
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
                                <button type="button" id="view" class="btn btn-outline-primary">View</button>
                                <button type="button" id="reset" class="btn btn-outline-danger ml-3">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Select Tank -->

            <!-- Table -->
            <table id="soundingTable" class="table">
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
    /** View Table Sounding **/
    $('#view').on('click', function (e) {
        e.preventDefault();
        axios.post("{{ route('master.fleets.sounding.detail', ['id'=>$fleet->id]) }}", {
            _token: document.head.querySelector('meta[name=csrf-token]').content,
            tank_id: $("#search_tank_id").val()
        }).then(response => {
            console.log(response)
        }).catch(error => {
            console.log(error)
        });
    })

    /** Reset Table **/
    $('#reset').on('click', function (e) {
        $("#search_tank_id").val("").change()
    })

    /** Download Template **/
    $('#downloadTemplate').on('click', function (e) {
        // code download
    })
})
</script>
@endpush