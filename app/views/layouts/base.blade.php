<!doctype html>
<html>
@include('headers.base')

<body>
<div class="wrapper">
  <div class="container">
    @section('header')
    <div class="row{{ isset($isEmergency) && $isEmergency ? ' emergency' : '' }}">
      <div class="col-md-4">
        @section('header_left')
        @show
      </div>
      <div class="col-md-4 text-center">
        <img src="{{ URL::to('images/'.(isset($isEmergency) && $isEmergency ? 'logo_emergency.jpg' : 'logo_a.jpg')) }}" width="200">
      </div>
      <div class="col-md-4">
        @section('header_right')
        @show
      </div>
    </div>
    @show

    <!-- main start -->
    <div class="main clearfix">
      @yield('content')
    </div>
    <!-- main end -->
  </div>
</div>
@include('footers.base')

@section('inline_script')
@show
</body>

</html>
