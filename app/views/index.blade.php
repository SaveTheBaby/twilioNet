@extends('layouts.base')

@section('header_left')
<div class="header-explain panel panel-default">
  {{ nl2br(<<< __MESSAGE__
  [Explanation]
  Please call +81-50-3159-6972 and follow the instruction to sign up as a mother. Once you complete the signup process, your information will be on the bottom of the Mother's List. Also, please check "Dashboard for Medical Personnel" for more details.
  *Currently, international phone rates are applied for calling from outside Japan. To avoid this, we are going to set up Twilio phone numbers in different countries in the near feature.
__MESSAGE__
  ) }}
</div>
@stop

@section('header_right')
<div class="header-explain panel panel-default">
  {{ nl2br(<<< __MESSAGE__
  [Explanation]
  There are two key features of simultaneous calling: "Notification" and "Questionnaire". "Notification" allows medical personnel to call simultaneously to mothers with any messages, and "Questionnaire" let medical personnel collect and analyze data of mothers and their babies. Please click "Notification" and "Questionnaire" for more details.
__MESSAGE__
  ) }}
</div>
@stop

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

  <div class="panel panel-default pull-right header-explain">
    Click "details" for more information of each mother and her baby
  </div>
  <h2>Mother's List</h2>

  @if (count($mothers) > 0)
  <table class="table table-bordered">
    <tr>
      @foreach (Mother::getMotherColumns() as $i)
      <th>
        {{ $i }}
      </th>
      @endforeach
      <th>
        Today
        <br>
        Baby's Current State
      </th>
      <th>
        &nbsp;
      </th>
    </tr>
    <?php $i=0; ?>
    @foreach ($mothers as $mother)
      @foreach ($mother->getMotherTable() as $c => $spec)
      <?php $btnClass = $i++ < 2 ? 'btn-danger' : 'btn-success' ?>
      <tr>
        @foreach ($spec['values'] as $value)
        <td>
          {{ $value }}
        </td>
        @endforeach
        <td class="text-center">
        <?php if ($mother->baby()->count() == 0) : ?>
          <img src="{{ asset('images/null.jpg') }}">
        <?php else : ?>
          <img src="{{ $mother->getHasBabyWithDiarrhea() ? asset('images/diarrhea.jpg') : asset('images/nothing.jpg') }}">
        <?php endif; ?>
        </td>
        <td class="text-center">
          <a href="info/{{ $mother->id }}" class="btn {{  $btnClass }} btn-block btn-sm">Detail</a>
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
      text: 'Number of pregnant women(in the past 9 months)'
    },
    xAxis: [{
      min: 1,
      categories: [
        <?php echo implode(', ', Mother::getCountPerMonth()->schedules) ?>
      ],
      title: {
        text: 'Months of Pregnancy',
        style: {
          color: '#185755'
        }
      }
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
        text: 'Number of pregnant women',
        style: {
          color: '#00ADA7'
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
        text: 'Number of babies(in the past 24 months)'
      },
      xAxis: [{
        categories: [
          <?php echo implode(', ', Baby::getCountPerMonth()->birthdays) ?>
        ],
        title: {
          text: 'Age in Months',
          style: {
            color: '#185755'
          }
        }
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
          text: 'Number of babies',
          style: {
            color: '#D9C099'
          }
        },
        opposite: false // 左側に表示
      },{ // height
          allowDecimals: false,
          min: 0,
          labels: {
            formatter: function() {
              return this.value;
            },
            style: {
              color: '#185755'
            }
          },
          title: {
            text: 'Numer of cases of diarrhea'
          },
          opposite: true // 右に表示
        }

      ],
      tooltip: {
        shared: true
      },
      plotOptions: {
        column: {
          pointPadding: -0.2
          ,
          borderWidth: 0
        }
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
        name: 'All Babies',
        color: '#D9C099',
        type: 'column',
        data: [
          <?php echo implode(', ', Baby::getCountPerMonth()->babyCounts) ?>
        ],
        marker: {
          enabled: true
        },
        tooltip: {
          valueSuffix: ' '
        }
      }, {
        name: 'Babies with Diarrhea',
        color: '#185755',
        type: 'column',
        data: [
          <?php echo implode(', ', Mother::getDiarrheaCountPerMonth()->one) ?>
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