@props(['url' => '/', 'active' => false, 'icon' => null, 'mobile' => false])

@if($mobile)
<a href="{{$url}}" class="block px-4 py-2.5 rounded-lg transition-all duration-200 {{$active ? 'bg-white/20 text-white font-semibold shadow-lg' : 'text-white/90 hover:bg-white/10 hover:text-white font-medium'}}">
    <div class="flex items-center gap-2">
        @if($icon)
        <i class="fa fa-{{$icon}} text-sm"></i>
        @endif
        <span>{{$slot}}</span>
    </div>
</a>
@else
<a href="{{$url}}" class="relative px-3 py-2 rounded-lg transition-all duration-200 {{$active ? 'text-white font-semibold bg-white/10' : 'text-white/90 hover:text-white hover:bg-white/10 font-medium'}}">
    <div class="flex items-center gap-2">
        @if($icon)
        <i class="fa fa-{{$icon}} text-sm"></i>
        @endif
        <span>{{$slot}}</span>
    </div>
    @if($active)
    <span class="absolute bottom-0 left-1/2 transform -translate-x-1/2 w-1/2 h-0.5 bg-white rounded-full"></span>
    @endif
</a>
@endif