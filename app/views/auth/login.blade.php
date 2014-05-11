@extends('layouts.base')

@section('content')

@include('messages')

<div class="row">
  <div class="col-sm-12">
    <div class="login-console">
      <form action="login" method="post" autocomplete="off">
      <div class="panel panel-primary">
        <div class="panel-heading">
          Save The Baby
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