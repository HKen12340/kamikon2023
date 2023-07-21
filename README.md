# Kamikon2023

作品名：Cooking Cross


## データベース
どのようなに使うかなどの情報を記載しておきます。

データベース名：ccr_db

### userテーブル

|フィールド名|データ型|値|説明|
|-|-|-|-|
|id|int(11)|1|ユーザID|
|user_name|vachar(100)|'kenta123'|ユーザ名|
|mail_addres|vachar(100)|'ken@ken.com'|メールアドレス|
|password|vachar(64)|'pas1234'|パスワード(ハッシュ自動変換)|

### recipeテーブル

|フィールド名|データ型|値|説明|
|-|-|-|-|
|id|int(11)|1|レシピID|
|user_id|int(11)|1|ユーザ用ID|
|recipe_name|varchar(100)|'卵かけ納豆キムチご飯'|レシピ名|
|introductions|text|'ウマイ！！！！(説明放棄)'|紹介文|
|material_names|text|'ご飯','納豆','卵','キムチ'|材料(CSV形式)|
|amounts|text|'とにかくいっぱい！！','1パック','1個','好きなだけ入れる！！！'|量(CSV形式)|
|procedures|text|'卵を割る！！！','材料を混ぜる！！','ウマイ！！！'|調理方法(CSV形式)|
|Release_flag|tinyint(1)|1|公開フラグ(1 = 公開、0 = 非公開)|
|create_at|timestamp|2023-07-14 09:44:46|レシピ作成時刻|

### recipe_picture

|フィールド名|データ型|値|説明|
|-|-|-|-|
|recipe_id|int(11)|1|レシピID|
|icon|text|'/kamikon2023/upload/1.jpg'|一覧ページ用の画像パス|
|img_name|text||詳細ページ用の画像パス|

### recipe_point

|フィールド名|データ型|値|説明|
|-|-|-|-|
|recipe_id|int(11)|1|レシピID|
|time_point|int(11)|1|時間ポイント|
|money_point|int(11)|1|お金ポイント|
|volume_point|int(11)|1|量ポイント|
|meat_point|int(11)|1|お肉ポイント|
|fish_point|int(11)|1|魚ポイント|
|vegetable_point|int(11)|1|野菜ポイント|

### favorite

|フィールド名|データ型|値|説明|
|-|-|-|-|
|user_id|int(11)|1|ユーザID|
|recipe_id|int(11)|1|レシピID|

### question(仮)
複数ポイントに対応できていないので改良する
|フィールド名|データ型|値|説明|
|-|-|-|-|
|id|int(11)|1|質問ID
|question|text|'疲れている?'|質問内容|
|point|int(11)|1|付与ポイント|
|point_type|int(11)|'time_point'|ポイントタイプ|
|next_question|int(11)||関連質問(ない場合は空)|
|category|int(11)|1|質問カテゴリー|

