@extends('layouts.dash')

@section('content')
    <main class="content">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-12">
                    <div class="card mb-3">
                        <div class="card-header">
                            Fleet Documents
                        </div>

                        <div class="card-body">
                            {{ Form::open(['route' => ['master.fleets.docs.upload', $fleet->id], 'enctype' => 'multipart/form-data', 'method' => 'POST']) }}
                            <div class="form-group mb-3">
                                <label>Fleet Name</label>
                                <input type="text" class="form-control" value="{{ $fleet->name }}" disabled readonly>
                            </div>
                            <div class="form-group mb-3">
                                <label>Document Name</label>
                                <input type="text" class="form-control" name="name">
                            </div>
                            <div class="form-group mb-3">
                                <label>Document File</label>
                                <input type="file" class="form-control" name="file">
                            </div>
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary">Upload</button>
                            </div>
                            {{ Form::close() }}
                            <hr>
                            
                            <table class="table">
                                <thead>
                                    <tr>
                                        <th style="width: 50px;">No</th>
                                        <th>Name</th>
                                        <th style="width: 150px;">Size</th>
                                        <th style="width: 200px;">Uploaded At</th>
                                        <th style="width: 100px;">Action</th>
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
                                        <td>
                                            <form method="POST" action="{{ route('master.fleets.docs.delete', $doc->id) }}">
                                                {{ csrf_field() }}
                                                {{ method_field('DELETE') }}
                                        
                                                <div class="form-group">
                                                    <input type="button" class="btn btn-danger btn-sm delete-btn" value="Delete">
                                                </div>
                                            </form>
                                        </td>
                                    </tr>
                                    @endforeach
                                </tbody>
                            </table>
                            {{ $docs->links() }}
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </main>
@endsection


@section('js')
<script>
$(document).ready(function(){
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