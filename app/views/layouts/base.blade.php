<!doctype html>
@include('headers.base')

<body>
<div class="wrapper">
  <div class="container">
    <div class="header clearfix text-center">
      <img src="{{ URL::to('images/logo_a.jpg'); }}" width="200">
    </div>

    <!-- main start -->
    <div class="main clearfix">
      @yield('content')
    </div>
    <!-- main end -->
  </div>
</div>
@include('footers.base')
</body>
</html>
