<?php
echo "<?xml version=\"1.0\" encoding=\"UTF-8\"?>\n";
// old
//ようこそ Save the babyへ！
//はじめに使用する４桁のユーザーアイディーを入力しシャープを押してください。

// new
//こんにちは！Save the Babyです
//"Save the Babyは、母子手帳を世界の公共財として電子化するプロジェクトです。
//途上国の通信環境に合わせ、携帯電話からの音声入力、プッシュ操作などによりデータを保存します。
//紙の母子手帳に付加価値を加え、防災・減災のための事前準備に普段から使えるツールとしての「母子の健康状態の記録」をバックアップします。
//"
//新規登録前に利用規約をお読みいただき、同意いただいた方はご登録ください。(準備中)
//はじめに、あなたの４桁のID番号をプッシュし、最後に♯（シャープ）を押してください。これがあなたのID番号となります。
?>
<Response>
  <Gather action='<?php echo $actionUrl ?>' method='GET' finishOnKey='#' timeout="60">
    <Say voice="woman">
      Hello,This is Save the Baby!
    </Say>
    <Pause />
    <Say voice="woman">
      Save the Baby is a service of digitalized Maternal and Child Health Handbook for developing countries.
    </Say>
    <Pause />
    <Say voice="woman">
      It’s a service to record health data using telephone line to suit for the communication environment of the developing countries.
    </Say>
    <Pause />
    <Say voice="woman">
      This service is useful not only in daily life but also in time of disaster.
    </Say>
    <Pause />
    <Say voice="woman">
      Please read user agreement before the new registration, and please register if you agree.
    </Say>
    <Pause />
    <Say voice="woman">
      User agreement is In preparation.
    </Say>
    <Pause />
    <Say voice="woman">
      First input 4-digit number, and then enter the Pound key.
    </Say>
    <Pause />
    <Say voice="woman">
      This is your ID number.
    </Say>
  </Gather>
</Response>