@extends('layouts.base')


@section('header_left')
<div class="header-explain panel panel-default">
  {{ nl2br(<<< __MESSAGE__
  Save the Baby is a service of digitalized Maternal and Child Health Handbook for developing countries. It can customize recording items such as necessary vaccination types and messages from the medical personnel adapting to the local situations.
__MESSAGE__
  ) }}
</div>
@stop

@section('header_right')
<div class="header-explain panel panel-default">
  {{ nl2br(<<< __MESSAGE__
  By digitalizing Maternal and Child Health Handbook and connect mothers and children with a view to prevent and mitigate their suffering in disasters. Health care centers and community health centers of the region can define the area with high-risk pregnant women and parturient mothers. It can also gather information including the number of infants in the area.
__MESSAGE__
  ) }}
</div>
@stop

@section('content')

@include('messages')

<div class="row">
  <div class="col-sm-12">
    <div class="login-console">
      <form action="login" method="post" autocomplete="off">
      <div class="panel panel-primary">
        <div class="panel-heading">
          Dashboard for Medical Personnel
        </div>
        <div class="panel-body">
          <div class="form-group">
            <label for="form-login-id">
              Login ID
            </label>
            <div class="input-group">
              <input type="text" id="form-login-id" name="LoginId" class="form-control" value="guest">
              <span class="input-group-addon">
                  <i class="glyphicon  glyphicon-user"></i>
                </span>
            </div>
          </div>
          <div class="form-group">
            <label for="form-password">
              Password
            </label>
            <div class="input-group">
              <input type="password" id="form-password" name="Password" class="form-control" value="guest">
              <span class="input-group-addon">
                  <i class="glyphicon  glyphicon-lock"></i>
                </span>
            </div>
          </div>
        </div>
        <div class="panel-footer clearfix">
          <button type="submit" class="btn btn-primary pull-right">Login</button>
        </div>
      </div>
      </form>
    </div>
  </div>
</div>


@endsection