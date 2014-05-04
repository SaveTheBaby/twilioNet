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
    Information
  </h2>

  <div class="row">
    <div class="col-sm-12">
      <form action="{{ URL::current() }}" method="post" autocomplete="off">
        <div class="form-group">
          <label for="form-content">
            Message
          </label>
          <textarea id="form-content" name="content" class="form-control" rows="6">粉ミルクが届きました
9月9日12時に広場にお集まり下さい</textarea>
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
    Information List
  </h2>

  @if (Session::get('user.name') == 'guest')
  <div class="text-right">
  *1 ログインIDがguestの方は送信できません。
  </div>
  @endif

  @if (count($information) > 0)

  <table class="table table-bordered">
    <tr>
      @foreach (Information::getInformationColumns() as $i)
      <th>
        {{ $i }}
      </th>
      @endforeach
    </tr>
    @foreach ($information as $i => $item)
    <tr>
      @foreach ($item->getInformationTableRow() as $row)
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