# API開発スターターキット (Tutorial 13)

このリポジトリは、API開発カリキュラム（Tutorial 13）のハンズオンで使用するスターターキットです。
Laravel 10.x と Laravel Sail (Docker) を使用した開発環境が構築されています。

## ✅ 前提条件

* **Docker Desktop** がインストールされ、起動していること。
* **Git** がインストールされていること。

## 🚀 環境構築手順

ターミナル（Windowsの場合はWSL2またはGit Bash推奨）を開き、以下の手順で環境を構築してください。

### 1. リポジトリのクローン
まずはプロジェクトをローカルにダウンロードします。

```bash
git clone https://github.com/coachtech-material/laravel-api-starter-forTutorial13.git
cd laravel-api-starter-forTutorial13
```

### 2. 依存パッケージのインストール

Dockerを使用してComposerパッケージをインストールします。ローカルにPHPやComposerがなくても実行可能です。

**Mac / Linux の場合:**

```bash
docker run --rm \
    -u "$(id -u):$(id -g)" \
    -v "$(pwd):/var/www/html" \
    -w /var/www/html \
    laravelsail/php82-composer:latest \
    composer install --ignore-platform-reqs
```

**Windows (PowerShell) の場合:**

```powershell
docker run --rm `
    -v "${PWD}:/var/www/html" `
    -w /var/www/html `
    laravelsail/php82-composer:latest `
    composer install --ignore-platform-reqs
```

### 3. 環境設定ファイルの作成

`.env.example` をコピーして `.env` ファイルを作成します。

```bash
cp .env.example .env
```

### 4. Docker環境の起動 (Laravel Sail)

コンテナを起動します。初回はイメージのビルドに数分かかる場合があります。

```bash
./vendor/bin/sail up -d
```

### 5. アプリケーションキーの生成

Laravelの暗号化キーを生成します。

```bash
./vendor/bin/sail artisan key:generate
```

### 6. データベースの準備 (マイグレーション & シーダー)

テーブルを作成し、テストデータを投入します。

```bash
./vendor/bin/sail artisan migrate:fresh --seed
```

### 7. 動作確認

ブラウザで以下のURLにアクセスしてください。LaravelのWelcomeページが表示されれば構築完了です。

* URL: http://localhost

---

## 📝 開発のヒント

### テストユーザーについて

シーダー (`UserSeeder`) により、以下のテストユーザーが自動的に作成されています。認証機能は実装されていませんが、タスクの所有者 (`user_id`) としてこのIDを使用します。

* **User ID**: `1`
* **Name**: `Test User`
* **Email**: `test@example.com`

### サンプルタスクについて

シーダー (`TaskSeeder`) により、テストユーザー（ID: 1）に紐づくサンプルタスクが5件作成されています。

### 開発フロー

Tutorial 13のハンズオンでは、主に以下のファイルを編集・作成します。

1. **ルーティング**: `routes/api.php`
2. **コントローラー**: `app/Http/Controllers/Api/` (新規作成)
3. **APIリソース**: `app/Http/Resources/` (新規作成)

### よく使うコマンド

* **コンテナの起動**: `./vendor/bin/sail up -d`
* **コンテナの停止**: `./vendor/bin/sail down`
* **Artisanコマンド**: `./vendor/bin/sail artisan ...`
* **ログの確認**: `./vendor/bin/sail logs -f`

### APIテストツール

本カリキュラムでは、VSCode拡張機能の **Thunder Client** を使用して動作確認を行います。
