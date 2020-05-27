# 徳丸本VMをNessusでプラットフォーム診断してみよう

- 本日お伝えしたいこと
  - Nessusを使った簡単な脆弱性スキャンの方法
  - 診断結果の見方

- 前提となる環境
  - 前回インストールしたNessus環境
  - 徳丸本VM（WordPressをインストールしたもの）、あるいは別の診断対象

# Nessusによる脆弱性スキャンの流れ

- ポリシーの設定（省略できるが設定を推奨）
  - 今回は以下の設定
  - ASSESMENT - General - Accuracy - Show potential false alarms
  - Web Applications - Scan web applications ON 
  - Credentials は設定しない（次回に説明予定）
  - wasbook という名称で保存
- All Scans から New Scanボタンを押す
  - ポリシーの選定 - 先程作ったポリシー(wasbook)を選択 
  - Settings でName（wasbook）とホスト名（あるいはIPアドレス）をexample.jp
  - Save
- Launchボタン?で実行
- あとはコーヒーでも飲んで待つ（1～2時間かかります）


動画URL : https://www.youtube.com/watch?v=1TDP8Rlsdnc

YouTubeチャンネル　[徳丸浩のウェブセキュリティ講座](https://www.youtube.com/channel/UCLNW6Bo_YU3TxnzsII2gEDA)
