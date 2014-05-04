@extends('layouts.base')

@section('content')


<div class="row">
  <div class="col-sm-12">

    @include('action')

    <a href="{{ URL::to('/') }}" class="btn btn-default pull-right" style="margin-right:4px">
      Back to Home
    </a>

  </div>
</div>

<hr>

@include('messages')


<div class="user-list">

  <h2>
    Health Check
  </h2>

  <div class="row">
    <div class="col-sm-12">
      <form action="health-check" method="post" autocomplete="off">
        <div class="form-group">
          <label for="form-question">
            Question
          </label>
          <textarea id="form-question" name="question" class="form-control" rows="6">下痢の赤ちゃんは１を
発熱は２
怪我をしている方は３
特に問題ない赤ちゃんは４を押して下さい。</textarea>
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

<div class="user-list">

  <h2>
    Health Check List
  </h2>

  @if (Session::get('user.name') == 'guest')
  <div class="text-right">
    *1 ログインIDがguestの方は送信できません。
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
          <a href="{{ $row['attributes']['url'] }}" class="{{ $row['attributes']['class'] }}">{{ $row['value'] }}</a>
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