@php
  $currentTab = request()->segment(2);
  $currentLink = request()->segment(3);
  $formatedLink = ucwords(str_replace('-', ' ', $currentLink));
  $formattedTab = ucwords(str_replace('-',' ', $currentTab));
@endphp
<div class="page-header">
    <h3 class="fw-bold mb-3">{{$formatedLink}}</h3>
    <ul class="breadcrumbs mb-3">
      <li class="nav-home">
        <a href="{{route('admin.dashboard')}}">
          <i class="icon-home"></i>
        </a>
      </li>
      <li class="separator">
        <i class="icon-arrow-right"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{$formattedTab}}</a>
      </li>
      <li class="separator">
        <i class="icon-arrow-right"></i>
      </li>
      <li class="nav-item">
        <a href="#">{{$formatedLink}}</a>
      </li>
    </ul>
  </div>
 