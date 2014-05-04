@extends('layouts.base')

@section('content')

<div class="row">
  <div class="col-sm-12">

    @include('action')

  </div>

</div>

<hr>

@include('messages')


<div class="panel panel-success">
  <div class="panel-heading text-center font-22">
    <?php
    if (getenv('APPLICATION_ENV') == 'development')
      echo '(development mode)';
    ?>
    <a href="tel:{{ Config::get('twilio.phoneNumber') }}">{{ Config::get('twilio.phoneNumber') }}</a>

  </div>
  <div class="panel-body">
    Please call above number to register!
  </div>
</div>

<div class="user-list">
  <h2>Mother's ID list</h2>

  @if (count($mothers) > 0)
  <table class="table table-bordered">
    <tr>
      @foreach (Mother::getMotherColumns() as $i)
      <th>
        {{ $i }}
      </th>
      @endforeach
      <th>
        &nbsp;
      </th>
    </tr>
    @foreach ($mothers as $mother)
      @foreach ($mother->getMotherTable() as $c => $spec)
      <tr>
        @foreach ($spec['values'] as $value)
        <td>
          {{ $value }}
        </td>
        @endforeach
        <td class="text-center">
          <a href="info/{{ $mother->id }}" class="btn btn-success btn-block btn-sm">Info</a>
        </td>
      </tr>
      @endforeach
    @endforeach
  </table>
  @else
  No Data
  @endif

</div>
@endsection