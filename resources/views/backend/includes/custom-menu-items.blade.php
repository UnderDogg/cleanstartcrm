@foreach($items as $item)
  <li class="nav-item px-5" data-test="test">
      <a href="{!! $item->url() !!}" class="nav-link">{!! $item->title !!} </a>
  </li>
@endforeach