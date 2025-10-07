@extends('layouts.dash')

@section('content')
<main class="content">
    <div class="bg-white">
        @if($fleet->submenu()->count() > 0)
            @include('fleet.menu', ['fleet' => $fleet])
        @else
            @include('fleet._menu', ['fleet' => $fleet])
            {{-- <slider-submenu :fleet="{{ json_encode($fleet) }}" active="balast"></slider-submenu> --}}
        @endif
        <div class="container">
            <div class="row mt-3">
                <div class="col-12">
                    <div class="table-title d-flex justify-content-between align-items-center">
                        <h6>Alarm Information</h6>
                        <div class="text-muted small">
                            @if(request()->anyFilled(['from', 'to', 'status', 'message']))
                                <span class="badge bg-info me-2">
                                    <i class="fa fa-filter me-1"></i> Filtered
                                </span>
                            @endif
                            <span>Total: {{ $alarms->total() }} records</span>
                        </div>
                    </div>
                    <div class="nav-button d-flex justify-content-end py-2">
                        <div class="d-flex align-items-center">
                            <form method="GET" class="d-flex align-items-center me-2" id="filterForm">
                                <date-range from="{{ request()->input('from', null) }}" to="{{ request()->input('to', null) }}"></date-range>
                                <div class="ms-2">
                                    <select name="status" class="form-select form-select-sm" style="min-width: 120px;">
                                        <option value="">All Status</option>
                                        <option value="1" {{ request()->input('status') == '1' ? 'selected' : '' }}>Abnormal</option>
                                        <option value="0" {{ request()->input('status') == '0' ? 'selected' : '' }}>Normal</option>
                                    </select>
                                </div>
                                <div class="ms-2">
                                    <input type="text" name="message" class="form-control form-control-sm" 
                                           placeholder="Search message..." 
                                           value="{{ request()->input('message') }}" 
                                           style="min-width: 150px;">
                                </div>
                                <button class="ms-2 btn btn-primary btn-sm" type="submit">
                                    <i class="fa fa-filter me-2"></i> Filter
                                </button>
                                <a href="{{ route('fleet.alarms', $fleet->id) }}" class="ms-1 btn btn-outline-secondary btn-sm">
                                    <i class="fa fa-times me-1"></i> Clear
                                </a>
                            </form>
                            <form method="GET" action="{{ route('fleet.alarms.download', $fleet->id) }}" class="d-inline">
                                @if(request()->input('from'))
                                    <input type="hidden" name="from" value="{{ request()->input('from') }}">
                                @endif
                                @if(request()->input('to'))
                                    <input type="hidden" name="to" value="{{ request()->input('to') }}">
                                @endif
                                @if(request()->input('status'))
                                    <input type="hidden" name="status" value="{{ request()->input('status') }}">
                                @endif
                                @if(request()->input('message'))
                                    <input type="hidden" name="message" value="{{ request()->input('message') }}">
                                @endif
                                <button class="btn btn-success btn-sm" type="submit">
                                    <i class="fa fa-download me-2"></i> Download CSV
                                </button>
                            </form>
                        </div>
                    </div>
                    
                    @if(request()->anyFilled(['from', 'to', 'status', 'message']))
                        <div class="alert alert-info py-2 mb-3">
                            <small>
                                <strong>Active filters:</strong>
                                @if(request()->input('from') || request()->input('to'))
                                    <span class="badge bg-primary me-1">
                                        Date: {{ request()->input('from', 'All') }} to {{ request()->input('to', 'All') }}
                                    </span>
                                @endif
                                @if(request()->input('status') !== null && request()->input('status') !== '')
                                    <span class="badge bg-primary me-1">
                                        Status: {{ request()->input('status') == '1' ? 'Abnormal' : 'Normal' }}
                                    </span>
                                @endif
                                @if(request()->input('message'))
                                    <span class="badge bg-primary me-1">
                                        Message: "{{ request()->input('message') }}"
                                    </span>
                                @endif
                            </small>
                        </div>
                    @endif
                    
                    <table class="table table-sm alarm">
                        <thead>
                            <tr>
                                <th>Date</th>
                                <th>Message</th>
                                <th>Duration</th>
                                <th>Status</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($alarms  as $alarm)
                            <tr class="{{ $alarm->status ? 'table-warning': '' }}">
                                <td>
                                    <small>{{ \Carbon\Carbon::parse($alarm->started_at)->format('M d, Y H:i:s') }}</small>
                                </td>
                                <td>
                                    <span class="text-break">{{ $alarm->message }}</span>
                                </td>
                                <td>
                                    <span class="badge bg-secondary">{{ $alarm->duration ?: '0' }}</span>
                                </td>
                                <td>
                                    @if($alarm->status)
                                        <span class="badge bg-danger">
                                            <i class="fa fa-exclamation-triangle me-1"></i>ABNORMAL
                                        </span>
                                    @else
                                        <span class="badge bg-success">
                                            <i class="fa fa-check-circle me-1"></i>NORMAL
                                        </span>
                                    @endif
                                </td>
                            </tr>
                            @empty
                            <tr>
                                <td colspan="4" class="text-center py-4">
                                    <div class="text-muted">
                                        <i class="fa fa-info-circle fa-2x mb-2"></i>
                                        <p class="mb-0">No alarms found</p>
                                        @if(request()->anyFilled(['from', 'to', 'status', 'message']))
                                            <small>Try adjusting your filters or <a href="{{ route('fleet.alarms', $fleet->id) }}">clear all filters</a></small>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                            @endforelse
                        </tbody>
                    </table>
                    {{ $alarms->appends(request()->query())->links() }}
                </div>
            </div>
        </div>
    </div>
</main>
@endsection

@push('scripts')
<script>
document.addEventListener('DOMContentLoaded', function() {
    // Allow Enter key to submit filter form
    const messageInput = document.querySelector('input[name="message"]');
    if (messageInput) {
        messageInput.addEventListener('keypress', function(e) {
            if (e.key === 'Enter') {
                e.preventDefault();
                document.getElementById('filterForm').submit();
            }
        });
    }
    
    // Auto-submit form when status changes
    const statusSelect = document.querySelector('select[name="status"]');
    if (statusSelect) {
        statusSelect.addEventListener('change', function() {
            document.getElementById('filterForm').submit();
        });
    }
});
</script>
@endpush
