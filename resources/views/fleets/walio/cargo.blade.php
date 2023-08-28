<div class="p-3">
    @php
       $menu = $fleet->submenu()->find(request()->input('sub_id', null));    
    @endphp
    @if($menu)
    <sensor-info title="{{ $menu->name }}" :fleet="{{ json_encode($fleet) }}" :sensors="[]"></sensor-info>
    @endif</div>