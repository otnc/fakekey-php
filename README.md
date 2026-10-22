# fakekey

アクセスするたびに、本物そっくりな偽物の RSA 秘密鍵 (PEM 形式、PKCS#1) を表示するページです。

中身はランダムなバイト列を ASN.1 DER の形に詰めただけなので、鍵としては使えません。生成処理は PHP で書いてあり、[vercel-php](https://github.com/vercel-community/php) ランタイムを使って Vercel のサーバーレス関数として動かしています。

## 必要なもの

- PHP 8 以降 (ローカルで動かす場合)
- Node.js と npm (コードを整形する場合)
- Vercel アカウント (デプロイする場合)

## 使い方

| コマンド         | 内容                                                          |
| ---------------- | ------------------------------------------------------------- |
| `npm run dev`    | PHP のビルトインサーバーで起動します (http://localhost:8000)  |
| `npm run format` | Prettier でコードを整形します (先に `npm install` が必要です) |

## デプロイ

GitHub にプッシュしたリポジトリを Vercel の [New Project](https://vercel.com/new) から読み込めば、あとはプッシュするたびに自動でデプロイされます。手元から直接デプロイしたいときは `npx vercel` を使ってください。

設定は `vercel.json` に書いてあり、`api/*.php` を vercel-php で動かして、`/` へのアクセスを `/api/index.php` に流しています。vercel-php は Node.js 22.x で動くので、`package.json` の `engines` で Node.js のバージョンを指定しています。

Vercel の Hobby プラン (無料) は非商用利用に限られます。

## ライセンス

[MIT License](./LICENSE) で公開しています。
