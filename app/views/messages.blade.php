@if (Session::has('error-message'))
<div class="row">
  <div class="col-sm-6 col-sm-offset-3">
    <div class="alert alert-danger alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{ Session::get('error-message') }}
    </div>
  </div>
</div>
@endif

@if (Session::has('success-message'))
<div class="row">
  <div class="col-sm-6 col-sm-offset-3">
    <div class="alert alert-success alert-dismissable">
      <button type="button" class="close" data-dismiss="alert" aria-hidden="true">&times;</button>
      {{ Session::get('success-message') }}
    </div>
  </div>
</div>
@endif