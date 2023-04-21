@extends('layouts.admin')
@section('title')
    @lang('settings.module_title')
@endsection
@section('content')
<div class="container-fluid">
  <div class="row">
      <div class="col-12">
          <div class="page-title-box">
            <h4 class="page-title">@lang('settings.module_title')</h4>
          </div>
      </div>
  </div>
  <div class="row">
    <div class="col-12">
      <div class="card">
        <div class="card-body shadow-lg">
          <div class="list-group">
            @php
              $base_url = URL::to('/');
            @endphp
            @foreach ($items as $item)
              <a href="{{$base_url.$item->link}}" class="list-group-item list-group-item-action">{{$item->name}}</a>
            @endforeach
          </div>
        </div>
      </div> 
    </div>
  </div>
</div>
@endsection