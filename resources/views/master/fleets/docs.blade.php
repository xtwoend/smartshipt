
@php
    $docs = $fleet->docs()->latest()->paginate(20);
@endphp


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
{{ $docs->links() }}

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