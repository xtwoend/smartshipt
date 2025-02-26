<!-- Upload Tank Correction Table -->
<div class="col-md-12 mt-3 mb-4">
    <div class="card">
        <div class="card-header bg-info justify-content-between">
            <h6 class="mb-0 text-white">Upload Tank Temperature Correction Table</h6>
            <button id="downloadTankCorrectionTemplate" class="btn btn-success">Download Template</button>
        </div>
        <div class="card-body">
            <div class="row">
                <div class="col-md-12">
                    <form id="formUploadCorrection" action="{{ route('master.fleets.tank-correction.upload', ['id'=>$fleet->id]) }}" method="POST" enctype="multipart/form-data">
                        {{ csrf_field() }}
                        <div class="mb-3">
                            <label for="file" class="form-label">Upload file (*.xlsx) : </label>
                            <input type="file" class="form-control" id="file" name="file">
                        </div>
                        <div class="mb-3 float-end">
                            <button id="submitFormCorrection" type="submit" class="btn btn-primary">Upload</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
<!-- End Upload Tank Correction Table -->

<div class="col-md-12">
    <div class="card">
        <div class="card-header bg-info">
            <h6 class="mb-0 text-white">Tank Temperature Correction Table</h6>
        </div>
        <div class="card-body">
            <!-- Table -->
            <table id="tankCorrectionTable" class="table">
                <thead>
                    <tr>
                        <th>Tank Temperature (°C)</th>
                        <th>Correction Factor</th>
                    </tr>
                </thead>
                <tbody>
                    
                </tbody>
            </table>
            <!-- End Table -->
        </div>
    </div>
</div>

@push('js_after')
<script>

function loadTable() {
    axios.post("{{ route('master.fleets.tank-correction.detail', ['id'=>$fleet->id]) }}", {
        _token: document.head.querySelector('meta[name=csrf-token]').content
    }).then(response => {
        if (response.data.success) {
            let lists = response.data.data;
            if (lists.length == 0) {
                $("#tankCorrectionTable tbody").html('');
                $("#tankCorrectionTable tbody").append(`<tr><td colspan="12" class="text-center text-danger"><i>No Data Found!</i></td></tr>`);
            }else {
                $("#tankCorrectionTable tbody").html('');
                $.each(lists, (index, item) => {
                    $("#tankCorrectionTable tbody").append(`<tr>
                        <td>${item.temp}</td>
                        <td>${item.correction}</td>
                    </tr>`)
                })
            }
        }
    }).catch(error => {
        console.log(error)
    });
}

$(document).ready(function () {
    /** Load Table **/
    loadTable();

    /** Submit Form **/
    $('#submitFormCorrection').on('click', function (e) {
        e.preventDefault();
        if (!(this).hasAttribute('disabled')) {
            $(this).attr('disabled', true);
        }

        $("#formUploadCorrection").submit();
    })

    /** Download Template **/
    $('#downloadTankCorrectionTemplate').on('click', function (e) {
        var a = document.createElement("a");
        a.href = "{{ url('/example/Tank%20Correction%20-%20Sambu.xlsx') }}";
        a.download = "Tank Correction - Sambu.xlsx";
        a.target = "_blank";
        document.body.appendChild(a);
        a.click();
        document.body.removeChild(a);
    })
})
</script>
@endpush