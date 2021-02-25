## URL

- https://aws-tripsupporter.com/
- ログイン画面にて簡単ログインができます。

## 概要

- 海外旅行に興味ある方がお気に入りの国を見つけられるアプリ(国は主にG20)
- 海外旅行の思い出話や貴重な体験を共有する
- 現在入国可能な国を見るけられる（コロナ禍）

## なぜこのアプリを制作したか

* 私は海外旅行が好きで海外旅行好きな人が集まり、素敵な旅行の思い出話や貴重な体験を共有しできるプラットフォームを作りたかった。
* 現在コロナ禍の為、海外旅行に行きたくても行けないという現状があります。  
しかし日本からの入国緩和をしている国がありそれらの情報も共有したかった。
*  個人的な趣味ですが様々な国の情報(人口やgdpなど)を数値化しランキング形式にし、様々な国の情報の知見を広げたかった。

## 機能

* ### フロントエンド
  * 通知機能 (jqueryのtoaster)
  * レビュー機能 (モーダルウィンドウでvue.jsでコンポーネント化)
  * レビューを星評価で簡単評価 (vue-star-ratingを使用)
  * フォーム入力のバリデーション (vee-validateを使用)
  * タブ切り替え機能 (vue.jsを使用)
  * ランキング機能（カテゴリー別にタブ切り替えにデーターはvue × axiosで非同期通信)
  * いいね機能
  * お気に入り登録後、解除ボタン表示
  * お気に入り解除後、登録ボタン表示
  *　フォトギャラリー(jquery litebox)

* ### バックエンド
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
  *　管理者ページ　各データーの編集、作成、削除(laravel-adminを使用)
  * faker ダミーデーター作成
  * Featureテスト機能

* ### CirclCi
  * 自動PHPUnitテスト
  * AWSに自動デプロイ

## 使用技術

* ### フロントエンド
  * Vue.js /2.6.12
  * Bootstrap /4.0
  * Sass /1.20.1
  * jQuery /3.2
  * Node.js /10.16.0
  * 星レビュー /vue-star-rating /1.7.0
  *　フロントバリデーション　/vee-validate/3.0.11

* ### バックエンド
  * PHP /7.2.34
  * Laravel /7.30.3
  * テスト /phpunit
  * Axios /0.19.0
  
* ### インフラ
  * Docker /20.10.2
  * Docker-compose /1.27.4
  * CircleCi
  * AWS (VPC,Route53,ALB,EC2,RDS,S3,ACM,EIP)
  * MySQL /5.8
  * Apache /2.4.46

* ### 管理者ページ
  * Laravel-admin (各データーの編集、作成、削除管理者によるデーター)

## 今後の予定

* SPA化
* ~~AWSを利用しデプロイ~~
* ~~SSL化~~
