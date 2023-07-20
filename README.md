# kamikon2023

作品名：Cooking Cross


## データベース
データベース名：ccr_db

### userテーブル

|id|int(11)|
|-|-|
|user_name|int(11)|
|mail_addres|vachar(100)|
|password|vachar(64)|

### recipeテーブル

|id|int(11)|
|-|-|
|user_id|int(11)|
|recipe_name|varchar(100)|
|introductions|text|
|material_names|text|
|amounts|text|
|procedures|text|
|Release_flag|tinyint(1)|
|create_at|timestamp|

### recipe_picture

|recipe_id|int(11)|
|-|-|
|icon|text|
|img_name|text|

### recipe_point
|-|-|
|recipe_id|int(11)|
|time_point|int(11)|
|money_point|int(11)|
|volume_point|int(11)|
|meat_point|int(11)|
|fish_point|int(11)|
|vegetable_point|int(11)|

### favorite
|-|-|
|user_id|int(11)|
|recipe_id|int(11)|

### question
|-|-|
|id|int(11)|
|question|text|
|point|int(11)|
|point_type|int(11)|
|next_question|int(11)|
|category|int(11)|

