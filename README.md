# simple-todo-app

## 概要

COACHTECH 旧教材　「TODOアプリを作成しよう」　で作成した成果物です。
検索機能のあるTODOアプリを作成しました。

## 使用技術

- PHP 8.x, Laravel 10.x
- PHPUnit（テスト）,
- FormRequest
- MySQL

## 環境構築・セットアップ手順

以下の手順に沿ってローカル開発環境を構築してください。

1. リポジトリのクローンと移動

```bash
git clone https://github.com/hayashi-hiroyuki40/simple-todo-app.git

cd simple-todo-app

2.Composer パッケージのインストール

Bash
docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v "$(pwd):/var/www/html" \
  -w /var/www/html \
  -e COMPOSER_CACHE_DIR=/tmp/composer_cache \
  laravelsail/php82-composer:latest \
  composer install

3.環境設定ファイル (.env) の作成

Bash
cp .env.example .env

4.Laravel Sail (MySQL) のセットアップ

Bash
docker run --rm \
  -u "$(id -u):$(id -g)" \
  -v "$(pwd):/var/www/html" \
  -w /var/www/html \
  -e COMPOSER_CACHE_DIR=/tmp/composer_cache \
  laravelsail/php82-composer:latest \
  php artisan sail:install --with=mysql

5.Dockerコンテナの起動

Bash
./vendor/bin/sail up -d

6.アプリケーションキーの生成

Bash
./vendor/bin/sail artisan key:generate

7.データベースのマイグレーション

Bash
./vendor/bin/sail artisan migrate
```

## 動作確認

セットアップ完了後、ブラウザで http://localhost にアクセスして動作を確認してください。

## テストの実行

```bash
./vendor/bin/sail artisan test
```
