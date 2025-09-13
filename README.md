# PiGLy

体重・摂取カロリー・運動時間を記録し、目標体重までの進捗を管理するアプリケーションです。
Laravel と Livewire を用いて開発されています。

## 環境構築

1. リポジトリ取得

- git clone [git@github.com:bunta27/pigly.git](https://github.com/bunta27/pigly.git)
- cd coachtech/laravel/Pigly

2. .env 作成

- cp src/.env.example src/.env

3. .env を docker-compose のサービス名に合わせて調整

- DB_CONNECTION=mysql
- DB_HOST=mysql
- DB_PORT=3306
- DB_DATABASE=laravel_db
- DB_USERNAME=laravel_user
- DB_PASSWORD=laravel_pass

4. コンテナ起動（ビルド）

- docker-compose up -d --build

5. PHP コンテナに入って依存関係をインストール

- docker-compose exec php bash
- composer install

6. アプリケーションキーを生成

- php artisan key:generate

7. パーミッション設定（重要）

- chown -R www-data:www-data /var/www/storage /var/www/bootstrap/cache
- chmod -R ug+rwX /var/www/storage /var/www/bootstrap/cache

8. マイグレーションの実行

- php artisan migrate

9. シーディングの実行

- php artisan db:seed

MySQL が起動しない場合は OS によって設定が必要になることがあります。各自の PC に合わせて `docker-compose.yml` の設定を調整してください。

## user のログイン用初期データ

- メールアドレス: test@example.com
- パスワード: password123

## 使用技術（実行環境）

- PHP 8.1.33
- Laravel 8.83.8
- Livewire v2.12.8
- MySQL 8.0.26
- Nginx 1.21.1
- Docker 28.3.2/ Doker Composer v2.39.1

## 注意点

- 言語設定  
config/app.php の locale が ja になっていることを確認してください。  
キャッシュが残っている場合は以下を実行：  

  php artisan config:clear  
  php artisan cache:clear

- ルーティング  
ログイン後の管理画面は /weight_logs がトップ（route 名 admin）です。  
/admin ではなく /weight_logs にアクセスしてください。

## ER 図

<img src="src/docs/ER.svg" alt="ER図" width="700">

## URL

- 開発環境 : http://localhost/login
- phpMyAdmin : http://localhost:8080/
