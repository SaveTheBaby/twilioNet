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
    ID
  </h2>

  <table class="table table-bordered">
    <tr>
      @foreach (Mother::getMotherColumns() as $i)
      <th>
        {{ $i }}
      </th>
      @endforeach
    </tr>
    @foreach ($mother->getMotherTable() as $c => $spec)
    <tr>
      @foreach ($spec['values'] as $value)
      <td>
        {{ $value }}
      </td>
      @endforeach

    </tr>
    @endforeach
  </table>
</div>

 <hr>

<div class="user-list">
  <h2>
    Maternal Health Data
  </h2>

  <div class="mother-check-chart" style="width:100%; height:400px;"></div>

  <table class="table table-bordered">
    <tr>
      <th>
        &nbsp;
      </th>
      @foreach (Mother::getCheckColumns() as $i)
      <th>
        {{ $i }}
      </th>
      @endforeach
    </tr>
    @foreach ($mother->getCheckTable() as $c => $spec)
    <tr>
      <th>
        {{ $spec['name'] }}
      </th>
      @foreach ($spec['values'] as $value)
      <td>
        {{ $value }}
      </td>
      @endforeach
    </tr>
    @endforeach
  </table>
</div>

<hr>

<div class="user-list">
  <h2>Baby</h2>

  @if ($mother->baby)

  <table class="table table-bordered">
    <tr>
      @foreach (Baby::getBabyColumns() as $i)
      <th>
        {{ $i }}
      </th>
      @endforeach
    </tr>
    @foreach ($mother->baby->getBabyTable() as $c => $spec)
    <tr>
      @foreach ($spec['values'] as $value)
      <td>
        {{ $value }}
      </td>
      @endforeach
    </tr>
    @endforeach
  </table>

  <hr>

  <h2>Cases of Diarrhea</h2>

  <table class="table table-bordered">
    <tr>
      @foreach (Mother::getDiarrheaColumns() as $i)
      <th>
        {{ $i }}
      </th>
      @endforeach
    </tr>
    @foreach ($mother->getDiarrheaTable() as $c => $spec)
    <tr>
      @foreach ($spec['values'] as $value)
      <td class="text-center">
        {{ $value }}
      </td>
      @endforeach
    </tr>
    @endforeach
  </table>

  <hr>

  <div class="baby-check-chart" style="width:100%; height:400px;"></div>

  <hr>

  <table class="table table-bordered">
    <tr>
      <th>
        &nbsp;
      </th>
      @foreach (Baby::getBabyCheckColumns() as $i)
      <th>
        {{ $i }}
      </th>
      @endforeach
    </tr>
    @foreach ($mother->baby->getBabyCheckTable() as $c => $spec)
    <tr>
      <th>
        {{ $spec['name'] }}
      </th>
      @foreach ($spec['values'] as $value)
      <td>
        {{ $value }}
      </td>
      @endforeach
    </tr>
    @endforeach
  </table>

  @else

  No Data

  @endif

</div>

<hr>

<div class="user-list">
  <h2>Baby's Vaccination Records</h2>

  @if ($mother->baby)

  <table class="table table-bordered">
    <tr>
      <th>
        &nbsp;
      </th>
      @foreach (Baby::getVaccinationColumns() as $i)
      <th>
        {{ $i }}
      </th>
      @endforeach
    </tr>
    @foreach ($mother->baby->getVaccinationTable() as $c => $spec)
    <tr>
      <th>
        {{ $spec['name'] }}
      </th>
      @foreach ($spec['values'] as $value)
      <td>
        {{ $value }}
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



@section('inline_script')
<script type="text/javascript">
  $(function () {
    $('.mother-check-chart').highcharts({
      chart: {
        zoomType: 'xy'
      },
      title: {
        text: 'Mother\'s Health Figures'
      },
      xAxis: [{
        categories: [
          <?php echo $mother->checkDateOfVisits() ?>
        ]
      }],
      yAxis: [{ // body_temperature
        label: {
          formatter: function() {
            return this.value + '°C'
          },
          style: {
            color: '#A8E0BA'
          }
        },
        title: {
          text: 'Body_Temperature(°C)',
          style: {
            color: '#A8E0BA'
          }
        },
        opposite: true
      }, { // height
        labels: {
          formatter: function() {
            return this.value + ' cm';
          },
          style: {
            color: '#00ADA7'
          }
        },
        title: {
          text: 'Height of abdomen(cm)',
          style: {
            color: '#185755'
          }
        },
        opposite: true // 右側に表示
      }, { // body_weight
        labels: {
          formatter: function() {
            return this.value + ' kg';
          },
          style: {
            color: '#D9C099'
          }
        },
        title: {
          text: 'Body_Weight(kg)',
          style: {
            color: '#D9C099'
          }
        },
        opposite: false // 左側に表示
      }],
      tooltip: {
        shared: true
      },
      legend: {
        layout: 'vertival',
        aligh: 'left',
        x: 120,
        varticalAlign: 'top',
        y: 80,
        floating: true,
        backgroundColor: '#FFF8D8'
      },
      series: [{
        name: 'Temperature',
        color: '#A8E0BA',
        type: 'column',
        data: [
          <?php echo $mother->checkTemperatures() ?>
        ],
        tooltip: {
          valueSuffix: ' °C'
        },
        yAxis: 1
      }, {
        name: 'Height',
        color: '#00ADA7',
        type: 'spline',
        data: [
          <?php echo $mother->checkHeightOfAbdomens() ?>
        ],
        marker: {
          enabled: true
        },
        tooltip: {
          valueSuffix: ' cm'
        },
        yAxis: 1
      }, {
        name: 'Weight',
        color: '#D9C099',
        type: 'spline',
        data: [
          <?php echo $mother->checkWeightInKg() ?>
        ],
        tooltip: {
          valueSuffix: ' kg'
        },
        yAxis: 2
      }]
    });

    @if ($mother->baby)
    $('.baby-check-chart').highcharts({
      chart: {
        zoomType: 'xy'
      },
      title: {
        text: 'Baby\'s Health Figures'
      },
      xAxis: [{
        categories: [
          <?php echo $mother->baby->checkDateOfVisits() ?>
        ]
      }],
      yAxis: [{ // body_temperature
        label: {
          formatter: function() {
            return this.value + '°C'
          },
          style: {
            color: '#A8E0BA'
          }
        },
        title: {
          text: 'Body_Temperature(°C)',
          style: {
            color: '#A8E0BA'
          }
        },
        opposite: true
      }, { // height
        labels: {
          formatter: function() {
            return this.value + ' cm';
          },
          style: {
            color: '#00ADA7'
          }
        },
        title: {
          text: 'Height(cm)',
          style: {
            color: '#185755'
          }
        },
        opposite: true // 右側に表示
      }, { // body_weight
        labels: {
          formatter: function() {
            return this.value + ' kg';
          },
          style: {
            color: '#D9C099'
          }
        },
        title: {
          text: 'Body_Weight(kg)',
          style: {
            color: '#D9C099'
          }
        },
        opposite: false // 左側に表示
      }],
      tooltip: {
        shared: true
      },
      legend: {
        layout: 'vertival',
        aligh: 'left',
        x: 120,
        varticalAlign: 'top',
        y: 80,
        floating: true,
        backgroundColor: '#FFF8D8'
      },
      series: [{
        name: 'Temperature',
        color: '#A8E0BA',
        type: 'column',
        data: [
          <?php echo $mother->baby->checkTemperatures() ?>
        ],
        tooltip: {
          valueSuffix: ' °C'
        },
        yAxis: 1
      }, {
        name: 'Height',
        color: '#00ADA7',
        type: 'spline',
        data: [
          <?php echo $mother->baby->checkHeight() ?>
        ],
        marker: {
          enabled: true
        },
        tooltip: {
          valueSuffix: ' cm'
        },
        yAxis: 1
      }, {
        name: 'Weight',
        color: '#D9C099',
        type: 'spline',
        data: [
          <?php echo $mother->baby->checkWeightInKg() ?>
        ],
        tooltip: {
          valueSuffix: ' kg'
        },
        yAxis: 2
      }]
    });
    @endif
  });
</script>
@stop