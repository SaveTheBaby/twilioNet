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