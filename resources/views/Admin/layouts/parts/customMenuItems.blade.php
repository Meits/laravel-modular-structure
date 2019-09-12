@foreach($items as $item)

    @if($item->group)
        <li class="nav-item-header">
            <div class="text-uppercase font-size-xs line-height-xs">{!! $item->title  !!}</div></li>
    @else
        <li @if($item->hasChildren()) class="nav-item-submenu" @else class="nav-item" @endif>
            <a href="{{ $item->url() }}" class="nav-link active">
                <span>{!! $item->title  !!}</span>
            </a>
            @if($item->hasChildren())
                <ul class="nav nav-group-sub" data-submenu-title="Layouts">
                    @include('administrator::layouts.parts.customMenuItems',['items'=>$item->children()])
                </ul>
            @endif
        </li>
    @endif
@endforeach