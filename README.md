#もぎたて


# Dockerビルド

1.git clone git@github.com:yukayamamioyuto101/mogitate.git

2.cd mogitate

3.docker-compose build
  docker-compose up -d

#Laravel環境構築

1.docker-compose exec php bash

2.composer install

3.cp .env .example .env

4.php artisan key:generate

5.php artisan migrate

6.php artisan db:seed


使用技術
　PHP
 
　Laravel
 
　Mysql
 

URL
　開発環境：http://localhost/products
  phpMyAdmin http://localhost:8080/

使いかた
1.	商品一覧ページで全商品を閲覧。商品名で検索、価格順で並び替えができる。
2.	商品をクリックすると、その商品の詳細が表示される。この詳細ページで商品情報の編集・更新、削除ができる
3.	商品一覧ページの商品を追加ボタンで商品登録ページへ遷移し、商品の情報の登録ができる。

# ER図
<img width="985" height="567" alt="image" src="https://github.com/user-attachments/assets/68ad37aa-d7c2-43d5-b72b-d5369bdbb842" />


