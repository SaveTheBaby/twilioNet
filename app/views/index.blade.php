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

<div class="mothers-chart" style="width:100%; height:400px; margin: 2em 0;"></div>

<div class="babies-chart" style="width:100%; height:400px; margin: 2em 0;"></div>

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

<script type="text/javascript">
$(function () {
  $('.mothers-chart').highcharts({
    chart: {
      zoomType: 'xy'
    },
    title: {
      text: 'Number of mother(in the past 9 months)'
    },
    xAxis: [{
      categories: [
        <?php echo implode(', ', Mother::getCountPerMonth()->schedules) ?>
      ]
    }],
    yAxis: [{ // height
      min: 0,
      allowDecimals: false,
      labels: {
        formatter: function() {
          return this.value;
        },
        style: {
          color: '#00ADA7'
        }
      },
      title: {
        text: 'Number of mother',
        style: {
          color: '#185755'
        }
      },
      opposite: false // 左側に表示
    }],
    tooltip: {
      shared: true
    },
    legend: {
      layout: 'vertical',
      align: 'left',
      x: 120,
      verticalAlign: 'top',
      y: 80,
      floating: true,
      backgroundColor: '#FFF8D8'
    },
    series: [{
      name: 'Mother',
      color: '#00ADA7',
      type: 'spline',
      data: [
        <?php echo implode(', ', Mother::getCountPerMonth()->motherCounts) ?>
      ],
      marker: {
        enabled: true
      },
      tooltip: {
        valueSuffix: ''
      }
    }]
  });


    $('.babies-chart').highcharts({
      chart: {
        zoomType: 'xy'
      },
      title: {
        text: 'Number of baby(in the past 24 months)'
      },
      xAxis: [{
        categories: [
          <?php echo implode(', ', Baby::getCountPerMonth()->birthdays) ?>
        ]
      }],
      yAxis: [{ // height
        allowDecimals: false,
        min: 0,
        labels: {
          formatter: function() {
            return this.value;
          },
          style: {
            color: '#D9C099'
          }
        },
        title: {
          text: 'Number of baby',
          style: {
            color: '#185755'
          }
        },
        opposite: false // 左側に表示
      }],
      tooltip: {
        shared: true
      },
      legend: {
        layout: 'vertical',
        align: 'left',
        x: 120,
        verticalAlign: 'top',
        y: 80,
        floating: true,
        backgroundColor: '#FFF8D8'
      },
      series: [{
        name: 'Baby',
        color: '#D9C099',
        type: 'spline',
        data: [
          <?php echo implode(', ', Baby::getCountPerMonth()->babyCounts) ?>
        ],
        marker: {
          enabled: true
        },
        tooltip: {
          valueSuffix: ' '
        }
      }]
    });
});
</script>
@endsection