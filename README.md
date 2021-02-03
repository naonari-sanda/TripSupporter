# URL

- https://tripsupporter.herokuapp.com/
- ログイン画面にて簡単ログインができます。

# 概要

- 海外に興味ある方がお気に入りの国を見つけるwebアプリ(国は主にG20)
- コロナ禍現在入国可能な国を見るけられる

# なぜこのアプリを制作したか

1. 昨今海外旅行に行きたい方が沢山いるが、コロナの影響の為多くの国が入国制限をしている、しかしながら日本からの入国を緩和している国があるがそれらをまとめているサイトが少なく、且つわかりにくい。  
解決→入国緩和制限をしている国を一発検索でき、その国のコロナ状況も把握できる。

2. 現状行きたい国が決まっていてインターネットで情報を集めるが旅行ブログ記事等などから情報を収集するがそれらの情報はその制作者の主観なので様々なブログ記事を読まなければいけなくなり、面倒。  
解決→レビュー機能を入れその国の情報を様々な方からの意見が得られる。(レビューを簡単にできる仕組みとして星評価機能を追加)

3. 現状様々な国をまとめているサイトが少なく、あったとしてもかなり情報が限定されていて旅行者の必要な情報が得られにくい。  
解決→様々な国をまとめ、旅行者に関して必要な情報が手に入り(言語や宗教,物価など)、レビュー機能、フォトギャラリー機能を入れコアな情報も入手可能。

4. 個人的な趣味ですが様々な国の情報(人口やgdpなど)を数値化しランキング形式にし、様々な国の情報の知見を広げたかった。

# 機能

## フロントエンド

* 通知機能 (jqueryのtoaster)
* レビュー機能 (モーダルウィンドウでvue.jsでコンポーネント化)
* レビューを星評価で簡単評価 (vue-star-ratingを使用)
* フォーム入力のバリデーション (vee-validateを使用)
* タブ切り替え機能 (vue.jsを使用)
* ランキング機能（タグによって様々なランキングを表示しデーターはvue × axiosで非同期通信)
* お気に入り登録機能
* お気に入り登録後、解除ボタン表示
* お気に入り解除後、登録ボタン表示
*　フォトギャラリー(jquery litebox)

## バックエンド

* Post送信はVue.jsとAxiosによる実装
* AND検索、OR検索
* 新規登録・ログイン・ログアウト機能
* パスワード変更
* プロフィール作成・編集・削除機能
* 国別レビュー作成・編集・削除機能
* お知らせ機能　(session)
* 画像アップロード機能(AWSのS3保存)
* フォームリクエストを使用しバリデーション
* メール送信機能
*　管理者ページ　各データーを編集、作成、削除(laravel-adminを使用)
* faker ダミーデーター作成
* Featureテスト機能

# 技術

* PHP /7.2.34
* Laravel /7.30.3
* Server /Apache
* database /mysql:5.7
* node.js /10.16.0
* テスト /phpunit
* vue.js /2.6.12
* sass /1.20.1
* jquery （お知らせ）toaster
* axios /0.19.0
* 星レビュー /vue-star-rating
*　フロントバリデーション　/vee-validate

### 管理者
* Laravel-admin

 ## 構築環境
 * Docker
* デプロイ/Heroku
* 画像保存(aws:s3)

# 今後の予定

* SPI化
* AWSを利用しデプロイ
