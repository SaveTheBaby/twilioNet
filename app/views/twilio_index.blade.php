<?php
  //header("content-type: text/xml");
  echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
?>
<Response>
<Gather action="http://savethebaby.heteml.jp/savethebaby1/public/twilio/check-type" method="GET">
<Say language="ja-jp">
お電話ありがとうございます。初めてのお電話の場合は1を、お子さんを授かった場合は2を,お子さんが生まれた場合は3を,お子さんの記録をつける場合は4を、お子さんの病気を記録する場合は5を、お子さんのお薬を記録する場合は6を,自分の記録をつける場合は7を、自分の病気の記録をつける場合は8を、自分の薬を記録する場合は9を押してください。
</Say>
</Gather>
</Response>
