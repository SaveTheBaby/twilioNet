@extends('layouts.user')

@section('content')
  <h1>Mother (id: {{$id}})</h1>
  <div id="container" style="min-width: 310px; height: 400px; margin: 0 auto"></div>
  @if(count($children) != 0)
    <div class="children">
      <h2>Children's birth</h2>
      <ul class="list-group">
        <?php foreach($children as $key => $value) : ?>
          <li class="list-group-item <?php if($key % 2 == 1) echo 'list-group-item-info'; ?>"><a href="{{URL::to('child')}}/{{$value['id']}}" class="btn btn-success">{{date("y/m/d", strtotime($value['created_at']))}}</a></li>
        <?php endforeach; ?>
      </ul>
    </div>
  @endif
  <div class="Vaccine">
    <h2>Vaccine List</h2>
    <table class="table table-triped">
      <thead>
        <tr>
          <th>Vaccine</th>
          <th>Date</th>
        </tr>
      </thead>
      <tbody>
        <tr>
          <td><a href="{{URL::to('vaccine')}}/1">はしかのワクチン</a></td>
          <td>2013/09/14</td>
        </tr>
        <tr class="success">
          <td>ポリオのワクチン</td>
          <td>2013/4/8</td>
        </tr>
        <tr>
          <td>破傷風のワクチン</td>
          <td>2013/1/18</td>
        </tr>
      </tbody>
    </table>
  </div>

    <div class="Vaccine">
    <table class="table table-triped">
      <tbody>
        <tr>
          <td><p class="btn btn-success">確認済み</p></td>
          <td><p class="btn btn-success">無事</p></td>
          <td>2013/8/3</td>
        </tr>
        <tr>
          <td><p class="btn btn-success">確認済み</p></td>
          <td><p class="btn btn-danger">SOS</p></td>
          <td>2013/8/2</td>
        </tr>
        <tr>
          <td><p class="btn btn-default">未確認</p></td>
          <td><p class="btn btn-default">不明</p></td>
          <td>2013/8/7</td>
        </tr>
      </tbody>
    </table>
  </div>
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
                ?> '2014/3/13']
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
            opposite: false
          }, { // height
            labels: {
              formatter: function() {
                return this.value + ' cm';
              },
              style: {
                color: '#185755'
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
            yAxis: 2
          }, {
            name: 'Height',
            color: '#185755',
            type: 'spline',
            data: [
              <?php foreach($records as $record) echo $record['height'] . ', '; ?> 160
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
              <?php foreach($records as $record) echo $record['body_weight'] . ', '; ?> 58
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