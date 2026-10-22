# fakekey

アクセスするたびに、本物そっくりな偽物の RSA 秘密鍵 (PEM 形式、PKCS#1) を表示するページです。

中身はランダムなバイト列を ASN.1 DER の形に詰めただけなので、鍵としては使えません。生成処理は PHP で書いてあり、[vercel-php](https://github.com/vercel-community/php) ランタイムを使って Vercel のサーバーレス関数として動かしています。

## 必要なもの

- PHP 8 以降 (ローカルで動かす場合)
- Node.js と npm (コードを整形する場合)
- Vercel アカウント (デプロイする場合)

## 使い方

| コマンド         | 内容                           |
| ---------------- | ------------------------------ |
| `npm run dev`    | PHP のビルトインサーバーで起動 |
| `npm run format` | Prettier でコードを整形        |

## デプロイ

GitHub にプッシュしたリポジトリを Vercel の [New Project](https://vercel.com/new) から読み込めば、あとはプッシュするたびに自動でデプロイされます。手元から直接デプロイしたいときは `npx vercel` を使ってください。

## ライセンス

[MIT License](./LICENSE) で公開しています。
