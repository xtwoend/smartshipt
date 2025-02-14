
@php
    $docs = $fleet->docs()->latest()->paginate(20);
@endphp

<!-- Upload Sounding Table -->
<div class="col-md-12 mt-3 mb-4">
    <div class="card">
        <div class="card-header bg-info">
            <h6 class="mb-0 text-white">Upload Sounding Table</h6>
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
                            <button type="button" id="resetForm" class="btn btn-outline-danger ml-3">Reset Form</button>
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
                                <select name="tank_id" id="tank_id" class="form-select">
                                    <option value="" disabled selected>-- SELECT TANK --</option>
                                    <option value="1">Tank 1</option>
                                    <option value="2">Tank 2</option>
                                </select>
                            </div>
                            <div class="col-md-3 d-flex gap-2 justify-content-end">
                                <button type="button" class="btn btn-outline-primary">View</button>
                                <button type="button" class="btn btn-outline-danger ml-3">Reset</button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <!-- End Select Tank -->

            <!-- Table -->
            <table class="table">
                <thead>
                    <tr>
                        <th style="width: 50px;">No</th>
                        <th>Name</th>
                        <th style="width: 150px;">Size</th>
                        <th style="width: 200px;">Uploaded At</th>
                        @can('Fleet Manage')
                        <th style="width: 100px;">Action</th>
                        @endcan
                    </tr>
                </thead>
                <tbody>
                    @php 
                        $no = (($docs->currentPage() - 1) * $docs->perPage()) + 1;
                    @endphp
                    @foreach($docs as $doc)
                
                    <tr>
                        <td>{{ $no++ }}</td>
                        <td>{{ $doc->name }}</td>
                        <td>{{ bytesToHuman($doc->size) }}</td>
                        <td>{{ $doc->created_at }}</td>
                        @can('Fleet Manage')
                        <td>
                            <form method="POST" action="{{ route('master.fleets.docs.delete', $doc->id) }}">
                                {{ csrf_field() }}
                                {{ method_field('DELETE') }}
                        
                                <div class="form-group">
                                    <input type="button" class="btn btn-danger btn-sm delete-btn" value="Delete">
                                </div>
                            </form>
                        </td>
                        @endcan
                    </tr>
                    @endforeach
                </tbody>
            </table>
            <!-- End Table -->
        </div>
    </div>
</div>

@section('js')
<script>
$(document).ready(function(){
    $('#resetForm').click(function(){
        console.log('dora')
    });
    $('.delete-btn').click(function(e){
        e.preventDefault() // Don't post the form, unless confirmed
        if (confirm('Are you sure?')) {
            // Post the form
            $(e.target).closest('form').submit() // Post the surrounding form
        }
    });
});
</script>
@endsection