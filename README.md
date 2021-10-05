# クリック数え練習
 SLACK上のリンクのクリック数を数えるためです。

概要：
    会社の先輩から頼まれた案件。
    SLACKに掲載したLINKを何人が押したかを確認したい。

コンセプト
    INDEXを開くと、LINKの欄がある。
    そこにLINK.1を入れると、新しい　LINK.2ができてLINKの目録ができる。
    LINK.2それをSLACKに掲載する。

    新しいLINK.2をおすと使用者には影響なくただLINK.1に飛ぶが、
    INDEXからLINKの目録からクリックが何回発生したかが分かる。

    これのために
    HTML,CSS,JAVASCRIPT,PHP、MYSQLの基礎を勉強したが、データベースのためのサーバーが必要であり、AWSも勉強しなければならない。

    21/08/06　朴（亨）

もっと細かくコンセプトを考えてみた。

    昨日（08/07）、SLACK上のリンクをクリックするとき、データベースのカウンターの数字が上がるように具現化しようとした。
    ただ具現化するのは簡単だと思ったが、実際の動きを考えるとまだ足りないところが多いことに気づいた。
    なので、コンセプトを決めてからコーディングを始める。

    1.　INDEX.php

    　inputFormとLINKの目録が表示される。
    　inputFromにLINKと説明を入れるとprocess_create.phpに移動。
      LINKの目録は入力したLINKの目録であり、クリック数も一緒に表示される。
      削除可能。
      
      
    2.　process_create.php
      inputFormからもらった情報をmysqlにLINKと説明がINSERTされ、idがふられる。
      ふられたidは link.phpの後ろにつけて、link.phpを使用者に表示する。

    
    3．link.php +id

      link.phpは使用者側には、開くとただ指定のリンクに行くだけ。
      link.phpは、idを持って,counterを上げる。


   21/08/08　朴（亨）
    
  
   INDEX.php と　process_create.php を完成した。
   感激だ。
   process_create.php　で、INSERTしたデータのIDをSELECTするのができなかったが、
   （WHERE＝LINKでSELECTすると、重複が発生するとき、IDを読み込むのができないため）
   最後のIDをSELECTすることで解決できた。

　 INDEXの目録を表示するwhile文は勉強するとき理解できたと思ったが、
　　実際に使ってみようとしたら実は理解できていなかった。
　　自分で使ってみる大事さを分かった。

　21/08/12 朴（亨）→子供の1歳の誕生日だ。感激！


  link.phpを作成した。
  使用者が入力したLINKに移動するためには、HTTP：//プロトコルが必要だが、
  HTTP：//がついてないLINKを入力する場合、ページ移動ができないため、
  strpos函数とIF文を活用して、HTTP：//の有無関係なく、移動できるようになった。

  INDEX.phpで使用してみた結果、SLACKに入力するlinkも目録に入れないと、使いにくいと気づいたので、追加した。
　
  今後、削除の具現と、AWSの勉強後、AWSの連動を行う予定。

  21/08/13 朴（亨）
 
 link.phpでHTTP：//プロトコルのIF文のエラーを発見したので、直した。
 ANDを使うと簡単に解決できるエラーだったが、検索だけでかなり時間がたってしまった。基本に充実するため、本屋でPHPの本を買ってきた。
 
 　削除の具現も完了した。
　今後はAWSの適応と、UIの改善を行う予定だ。
　AWSを調べたら分からないところが多かったので、講義やブログを見つけて基礎からならっていく予定。

　21/08/14 朴（亨）

aws の　EC2,S3,RDSなどの技本を調べて、使い方をYOUTUBEで習った。
簡単そうだったが、EC2の駆動ができない。
WINDOWをつかっているためSSHを設置しなければならないことが分かったので、トライしてる。
サーバーのOSはLINUXが技本だと勉強中分かったので、ＵＤＥＭＹでLINUXの講義も購入。

　21/08/19 朴（亨）


AWSのEC2‐LINUXの設定が完了できた。
puTTYを利用すると簡単だった。
LINUXが開かれたが、使用したこともないので、検索でphpとサーバを設置した。
やりたいことをすべて検索することは時間がもったいないので、
明日からLINUXの勉強を始める。

21/08/20 朴（亨）

LINUXの講義の中で、LINUXはただのCmdではないことが分かった。
GUIを設置すれば、WINDOWと似ているように使える。
講義ではAWSを使わないので、GUIの設置のためのROOTログインGUI設置などを行った。
そして練習のコマンドをいくつか実習した。


21/08/21 朴（亨）

LINUXの技本操作を習った。
PUTTYを使うと、GUIをするためにはXmingが必要だった。。
PHP、APACHEの動作も確認した。
簡単だったが、検索からやるのには、総計10時間以上かかった。
それでもできてよかった。。


21/08/25 朴（亨）

linux-centos 環境で、
PHP、APACHE、MYSQLを設置し、
GUIの設定（PHPの動作確認）
外部のブラウザからのindex.phpの接続まで完了し、

LINKのPHPファイルをEC2に入れて、
外部のブラウザから動作できることを確認した。
IPが変動することなどまだ課題が残っているため、
修正をする予定だが、無事に動作することを確認してうれしい。


収穫
linux-centosに慣れた。vi編集、cdコマンドなど簡単な操作

PHP、APACHE、MYSQLの設置はとっても簡単だが、
古い情報のブログがあって意外と時間がかかった。yum などを習えた。

GUIも簡単だったが、puttyを利用すると、Xmingの設置を行わないと行けないことに気づくのにすごく時間がかかった。

外部のブラウザからの接続はAWSの方はセキュリティ設定を行って問題なかったが、できなくてすごく迷っていた。
5時間かかってLINUXの環境でポートを開いてあげないと行けないことが分かって、80、443のポートを開くことで解決。

いろいろ設置したり試しすぎて、AWSから課金されていた。。が、
LOCAL環境以外に使える物を具現化したことにすごく感激した。


21/08/27 朴（亨）

OG tagが出てないが、テスト版として永田さんに使ってもらった。
link.php を入力したとき、OG tag がSLACKに表示されたいと、接近性が悪いと思って、追加したいが、なかなかできない。
JSのlocaction.replace に問題があるかと考える。

21/09/03　朴（亨）


2週間関西支社出張のため、動画でPHPを勉強していた。
OG tag を持ってくるのは成功したが、それをHTMLに表示させてなかったため、SLACKに表示できなかった。
そして、SLACKにLINKを添付すると、SLACKが1回添付LINKを読み取るため、クリックしたことになって、LINKをはるだけでクリック数が１になったため、クリック数の初期値を-1にした。
LINKをはるとき1回読み取った情報は保存されるため、他のSLACKのチャネルに同じリンクを何回添付しても、クリック数は上がらなかったため、
‐1でよろしいと判断した。

21/09/19　朴（亨）

テストでクリックを何回かしてみることで、カウント数が上がるので、クリック数を調整するためのボタンをいれた。

21/09/27　朴（亨）


パスワード機能を入れてみたが、sessionなしで、基礎知識で具現できるかなと思ったが、
やはりsessionじゃないと、ログインを維持するのが難しくて、sessionをつかいます。
※login.phpを追加した。
index.phpに接続してもログインしないと入れないようにした。

21/10/06　朴（亨）