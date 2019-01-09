# wp-mddfeed

Minkabu Data Dictionary(MDD)向けのフィードを提供するプラグインです。

Wordpressコアの `wp-includes/feed-rss2.php` をベースに改変しています。

## インストール方法

mddfeedディレクトリをpluginsフォルダに置き、管理画面から有効にします。

## フィードURL

example.com というドメインでWordpressを公開した場合、以下がフィードのURLになります。

* http://example.com/?feed=mdd
* http://example.com/feed/mdd/

※後者はパーマリンクを利用している場合です。

詳しくは、[WordPress フィード配信](http://wpdocs.osdn.jp/WordPress_%E3%83%95%E3%82%A3%E3%83%BC%E3%83%89%E9%85%8D%E4%BF%A1)をご覧ください。

## 改変ポイント

* `post-status`が`publish`に加えて、`trash`と`private`の記事も出力するようにした
* `post_name`が`__trashed`で始まる記事は出力対象外とした
* MDD専用の記事ステータス`mdd:status`の項目を追加した


## 改変理由

通常のWordpressフィードは公開`publish`しか出力しません。

これだとMDD側は、公開後の取り込み済み記事が削除されたり、非公開になったことに気づくことが出来ず、Wordpress側では削除したにもかかわらずMDD側で公開されたままになってしまいます。

これを検知するには削除状態`trash`と非公開状態`private`の記事もフィードに出力する必要があります。

その際、MDD側は専用のフィード項目`mdd:status`が`Canceled`のものを認識し、当該記事をキャンセル扱いとします。

ちなみに、Wordpress側で下書きから一度も公開せずに削除した場合は、公開された記事がないためフィードに出力してはいけません。

`post_name`が`__trashed`のものがそれに該当し、フィード出力対象外となっています。

## 注意点

下書きから一度も公開せずに削除した場合は`post_name`で判断できますが、下書きから直接非公開にしたものは判断できません。

そのため、下書きの記事を取り消したい場合は非公開にせず、削除してください。
