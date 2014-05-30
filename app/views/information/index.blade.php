@extends('layouts.base')

@section('header_left')
<div class="header-explain panel panel-default">
  {{ nl2br(<<< __MESSAGE__
  [Explanation]
  The simultaneous calling function has already been implemented; however, "Call" buttons don't work since this is a demonstration version.
  A push on the emergency button will also change Message list to business at the time of a disaster.
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
    <a href="{{ URL::to('information') }}?emergency" class="btn btn-danger">Emergency</a>
    <a href="{{ URL::to('/') }}" class="btn btn-default pull-right" style="margin-right:4px">
      Back to Home
    </a>

  </div>
</div>

<hr>

@include('messages')


<div class="user-list">

  <h2>
    Notification
    <small>
      Simultanious calling to mothers with any messages
    </small>
  </h2>

  <div class="row">
    <div class="col-sm-12">
      <form action="{{ URL::current() }}{{ isset($isEmergency) && $isEmergency ? '?emergency' : '' }}" method="post" autocomplete="off">
        <div class="form-group">
          <label for="form-content">
            Create new message
          </label>
          <textarea id="form-content" name="content" class="form-control" rows="6">
Up to one year old, your baby will love to be held.  
You should hold your child if they look scared or worried.  
Being held by you will relax them!
          </textarea>
        </div>
        <div class="form-group">
          <button type="submit" class="btn btn-primary pull-right">
            Add
          </button>
          <!--
          <div class="col-md-2 pull-right">
            <select name='type' class="form-control">
              <option value="1">Normal</option>
              <option value="2">Disaster</option>
            </select>
          </div>
          -->
        </div>
      </form>
    </div>
  </div>

</div>

<hr>

<div id="information-list" class="user-list">

  <h2>
    Message list
  </h2>

  @if (Session::get('user.name') == 'guest')
  <div class="text-right">
    *1 "guest" user ID(=test user) Can not call.
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
          <a href="{{ $row['attributes']['url'].(isset($isEmergency) && $isEmergency ? '&emergency' : '') }}" class="{{ $row['attributes']['class'] }}">
            {{ $row['value'] }}
          </a>
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