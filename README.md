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
    




 


