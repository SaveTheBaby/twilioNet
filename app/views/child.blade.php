@extends('layouts.user')

@section('content')
  <h1>Child (birth: <!-- {{date("y/m/d", strtotime($me['created_at']))}}--> 2013/7/8)</h1>
  <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
  <div class="mother">
    <h2>Mother's id</h2>
    <ul class="list-group">
      <li class="list-group-item">
        <a href="{{URL::to('mother')}}/{{$me['mother_id']}}" class="btn btn-success">{{$me['mother_id']}}</a>
      </li>
    </ul>
  </div>
  @if(count($children) != 1)
  <div class="children">
    <h2>Child's birth</h2>
    <ul class="list-group">
      <?php foreach($children as $key => $value) : ?>
        @if($value['id'] != $me->id)
          <li class="list-group-item <?php if($key % 2 == 1) echo 'list-group-item-info'; ?>"><a href="{{URL::to('child')}}/{{$value['id']}}" class="btn btn-success">{{date("y/m/d", strtotime($value['created_at']))}}</a></li>
        @endif
      <?php endforeach; ?>
    </ul>
  </div>
  @endif
  <script type="text/javascript">
  $(function () {
     $('#container').highcharts({
          chart: {
              zoomType: 'xy'
          },
          title: {
              text: 'Helth Graph'
          },
          xAxis: [{
              categories: [<?php foreach($records as $record)
                echo '\''.$record['time'].'\', ';
                ?> '2014/3/15']
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
              <?php foreach($records as $record) echo $record['body_temperature'] . ', '; ?> 36
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
              <?php foreach($records as $record) echo $record['height'] . ', '; ?> 80
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
              <?php foreach($records as $record) echo $record['body_weight'] . ', '; ?> 11
            ],
            tooltip: {
              valueSuffix: ' kg'
            },
            yAxis: 2
          }]
      });
  });
  </script>
@endsection