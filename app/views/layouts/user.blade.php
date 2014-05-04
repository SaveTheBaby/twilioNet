<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" lang="ja" xml:lang="ja">
@include('headers.user')

<body>
<div class="wrapper">
  <div class="container">
    <div class="header clearfix">
      <h1 class="text-center">SAVE THE BABY</h1>
    </div>
    <!-- main start -->
    <div class="main clearfix">
      @yield('content')
    </div>
    <!-- main end -->
  </div>
</div>
@include('footers.user')
</body>
</html>