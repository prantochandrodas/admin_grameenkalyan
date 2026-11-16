{{-- Nav --}}
<ul class="navi navi-hover py-4">
    @php
        $lang_keys = config('laravellocalization.supportedLocales');
    @endphp
    @foreach($lang_keys as $key => $value)
    @php
    $flag='media/svg/flags/'.$key.'.svg';
    $url=modifiedUrl(app()->getLocale(),request()->path());
   @endphp
    {{-- Item --}}
    <li class="navi-item">
        <a href="/{{$key}}{{$url}}" class="navi-link">
            <span class="symbol symbol-20 mr-3">
                <img src="{{ asset($flag) }}" alt=""/>
            </span>
            <span class="navi-text">{{$value['name']}}</span>
        </a>
    </li>

    @endforeach

</ul>
