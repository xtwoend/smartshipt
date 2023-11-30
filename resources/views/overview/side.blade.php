<ul class="list-group">
    <li class="list-group-item">
        <a href="{{ route('overview.index') }}">
            Mileage Overview
        </a>
    </li>
    <li class="list-group-item">
        <a href="{{ route('overview.speed') }}">
            Speed Overview
        </a>
    </li>
    <li class="list-group-item">
        <a href="#">
            Percentage Cargo Overview
        </a>
    </li>
    <li class="list-group-item">
        <a href="{{ route('overview.duration', ['status' => 'at_port']) }}">
            Duration At Port Overview
        </a>
    </li>
    <li class="list-group-item">
        <a href="{{ route('overview.duration', ['status' => 'underway']) }}">
            Duration Underway Overview
        </a>
    </li>
    <li class="list-group-item">
        <a href="{{ route('overview.duration', ['status' => 'anchorage']) }}">
            Duration Anchorage Overview
        </a>
    </li>
    <li class="list-group-item">
        <a href="{{ route('overview.duration', ['status' => 'lost_connection']) }}">
            Duration Lost Connection Overview
        </a>
    </li>
</ul>