<?php
// page located at http://example.com/process_gather.php
//header("content-type: text/xml");
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
echo "<Response>";
  if(($digit = $_REQUEST['Digits']) == 1) {
  //if(($digit = 1) == 1) {
    //初めて
    echo "<Gather action='http://savethebaby.heteml.jp/savethebaby1/public/twilio/create-mother-user-id' method='GET' finishOnKey='#'>";
    echo "<Say language='ja-jp'>";
    echo "はじめに使用するユーザーアイディーを入力しシャープを押してください";
    echo "</Say>";
    echo "</Gather>";
  }
  else if($digit == 2) {
    //妊娠
    echo "<Gather action='http://savethebaby.heteml.jp/savethebaby1/public/twilio/create-child' method='GET' finishOnKey='#'>";
    echo "<Say language='ja-jp'>";
    echo "おめでとうございます.　まず自分のユーザーアイディーを入力しシャープを押してください。";
    echo "</Say>";
    echo "</Gather>";

  } 
  else if ($digit == 3) {
    //子供生まれる
    echo "<Gather action='http://savethebaby.heteml.jp/savethebaby1/public/twilio/observe-child?type=birth' method='GET' finishOnKey='#'>";
    echo "<Say language='ja-jp'>";
    echo "おめでとうございます.自分のUserIdを入力し#を押してください";
    echo "</Say>";
    echo "</Gather>";
  }
  else if ($digit == 4) {
    //子供の身長、体重、体温
    echo "<Say language='ja-jp'>";
    echo "おめでとうございます.お子さんの身長を入力してください";
    //echo "<Gather action='http://fan-club.net/twilio_dev/input_height.php' method='GET'>";
    //echo "</Gather>";
    echo "</Say>";
    echo "<Say language='ja-jp'>";
    echo "次にお子さんの体重を入力してください";
    //echo "<Gather action='http://fan-club.net/twilio_dev/input_body_weight.php' method='GET'>";
    //echo "</Gather>";
    echo "</Say>";
    echo "<Say language='ja-jp'>";
    echo "次にお子さんの体温を入力してください";
    //echo "<Gather action='http://fan-club.net/twilio_dev/input_body_weight.php' method='GET'>";
    //echo "</Gather>";
    echo "</Say>";
  }
  else if ($digit == 5) {
    //子供の病気
    echo "<Say language='ja-jp'>";
    echo "病気の番号を入力してください";
    echo "</Say>";

  }
  else if ($digit == 6) {
    //子供の薬
    echo "<Say language='ja-jp'>";
    echo "薬の番号を入力してください";
    echo "</Say>";

  }
  else if ($digit == 7) {
    //自分の身長、体重、体温
    //子供の身長、体重、体温
    echo "<Say language='ja-jp'>";
    echo "自分の身長を入力してください";
    //echo "<Gather action='http://fan-club.net/twilio_dev/input_height.php' method='GET'>";
    //echo "</Gather>";
    echo "</Say>";
    echo "<Say language='ja-jp'>";
    echo "次に自分の体重を入力してください";
    //echo "<Gather action='http://fan-club.net/twilio_dev/input_body_weight.php' method='GET'>";
    //echo "</Gather>";
    echo "</Say>";
    echo "<Say language='ja-jp'>";
    echo "次に自分の体温を入力してください";
    //echo "<Gather action='http://fan-club.net/twilio_dev/input_body_weight.php' method='GET'>";
    //echo "</Gather>";
    echo "</Say>";
  }
  else if ($digit == 8) {
    //自分の病気
    echo "<Say language='ja-jp'>";
    echo "病気の番号を入力してください";
    echo "</Say>";

  }
  else if ($digit == 9) {
    //自分の薬
    echo "<Say language='ja-jp'>";
    echo "薬の番号を入力してください";
    echo "</Say>";

  }
echo "</Response>";

?>