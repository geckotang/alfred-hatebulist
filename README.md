# HatebuList.alfredworkflow

このワークフローでは[はてなブックマークのマイブックマーク全文検索API](http://developer.hatena.ne.jp/ja/documents/bookmark/apis/fulltext_search)を使っています。
また[はてなのWSSE認証](http://developer.hatena.ne.jp/ja/documents/auth/apis/wsse)を使うため、APIキーを取得する必要があります。

https://www.hatena.ne.jp/**ユーザー名**/config/mail/upload  
上記URLのページで表示された、投稿メールアドレスの**"@"以前の文字列**がAPIキーとなります。
また、ユーザー名とAPIキーは``~/.hatebulist``のファイルを作り、そこに保存しています。

APIキーを取得したら、``hl_setting <USERNAME> <APIKEY>``を実行してください。

[Download](https://github.com/geckotang/alfredworkflow/raw/master/HatebuList.alfredworkflow)

## Commands

- ``hl_setting <USERNAME> <APIKEY>``
- ``hl <KEYWORD>``
