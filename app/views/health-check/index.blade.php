@extends('layouts.base')

@section('header_left')
<div class="header-explain panel panel-default">
  {{ nl2br(<<< __MESSAGE__
  The simultaneous calling function has already been implemented; however, "Call" buttons don't work since this is a demonstration version.
__MESSAGE__
  ) }}
</div>
@stop

@section('header_right')
@stop

@section('content')


<div class="row">
  <div class="col-sm-12">

    @include('action')
    <a href="{{ URL::to('health-check') }}?emergency" class="btn btn-danger">Emergency</a>
    <a href="{{ URL::to('/') }}" class="btn btn-default pull-right" style="margin-right:4px">
      Back to Home
    </a>

  </div>
</div>

<hr>

@include('messages')


<div class="user-list">

  <h2>
    Health Check Questionnaire
  </h2>

  <div class="row">
    <div class="col-sm-12">
      <form action="{{ URL::current() }}{{ isset($isEmergency) && $isEmergency ? '?emergency' : '' }}" method="post" autocomplete="off">
        <div class="form-group">
          <label for="form-question">
            Create new questionnaire
          </label>
          <textarea id="form-question" name="question" class="form-control" rows="6">
＜In the disaster case: mother and baby example 1＞
Hello, this is "Save the Baby". This is the disaster relief team. On the 10th of September, doctors will come for your baby's health checkup. 
Press 1, if your baby has diarrhea. 
Press 2, if your baby has a fever. 
Press 3, if your baby has an injury. 
Press 0, to finish. 
The checkup entry is done. 
The information about your next checkup will be announced through SMS.
</textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary pull-right">
            Add
          </button>
        </div>
      </form>
    </div>
  </div>

</div>

<hr>

<div id="health-check-list" class="user-list">

  <h2>
    Questionnaire List
  </h2>

  @if (Session::get('user.name') == 'guest')
  <div class="text-right">
    *1 "guest" user ID(=test user) Can not call.
  </div>
  @endif

  @if (count($healthCheck) > 0)

  <table class="table table-bordered">
    <tr>
      @foreach (HealthCheck::getHealthCheckColumns() as $i)
      <th>
        {{ $i }}
      </th>
      @endforeach
    </tr>
    @foreach ($healthCheck as $i => $item)
    <tr>
      @foreach ($item->getHealthCheckTableRow() as $row)
      <td>
        @if ($row['type'] == 'text')
          {{ $row['value'] }}
        @elseif ($row['type'] == 'link')
          <a href="{{ $row['attributes']['url'].(isset($isEmergency) && $isEmergency ? '&emergency' : '') }}" class="{{ $row['attributes']['class'] }}">{{ $row['value'] }}</a>
        @endif
      </td>
      @endforeach
    </tr>
    @endforeach
  </table>

  @else

  No Data

  @endif


</div>

@endsection