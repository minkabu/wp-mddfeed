# wp-mddfeed

Minkabu Data Dictionary(MDD)向けのRSSフィードを提供するプラグインです。

Wordpressコアの `wp-includes/feed-rss2.php` をベースに改変しています。

## フィードURL

example.com というドメインでWordpressを公開した場合、
http://example.com/?feed=mdd
もしくは
http://example.com/feed/mdd/
がフィードのURLになります。
※後者はパーマリンクを利用している場合です。

詳しくは、[WordPress フィード配信](http://wpdocs.osdn.jp/WordPress_%E3%83%95%E3%82%A3%E3%83%BC%E3%83%89%E9%85%8D%E4%BF%A1)をご覧ください。

## 改変ポイント

* `post-status`が`publish`に加えて、`trash`と`private`の記事を出力する
* `post_name`が`__trashed`で始まる記事は出力対象外とする
* MDD専用の記事ステータス`mdd:status`の項目を追加する


## 改変理由

通常のWordpressフィードは公開`publish`しか出力しません。これだと、記事を取り込むMDD側は記事が削除されたことに気づけません。

そのため、`trash`と`private`の状態の記事も出力しています。その際に、`mdd:status`を`Canceled`と合わせて出力しています。

一方、Wordpressで一度も公開せずに下書き状態のものを削除した場合は、出力対象外公開された記事がないためフィードに出力してはいけません。

`post_name`が`__trashed`のものがそれに該当します。

## 注意点

公開せずに下書きから削除したものは`post_name`で判断できますが、公開せずに非公開にしたものは判断できませんので、
そのようなオペレーションを避けてもらう必要があります。
