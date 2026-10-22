<?php
function asn1Encode(string $tag, string $data): string
{
  $len = strlen($data);
  if ($len < 128) {
    $lenBytes = chr($len);
  } else {
    $lenStr = "";
    $tempLen = $len;
    while ($tempLen > 0) {
      $lenStr = chr($tempLen & 0xff) . $lenStr;
      $tempLen >>= 8;
    }
    $lenBytes = chr(0x80 | strlen($lenStr)) . $lenStr;
  }
  return $tag . $lenBytes . $data;
}

function asn1Integer(string $bytes): string
{
  if ((ord($bytes[0]) & 0x80) !== 0) {
    $bytes = "\x00" . $bytes;
  }
  return asn1Encode("\x02", $bytes);
}

function generateFakeRsaPrivateKey(): string
{
  $version = asn1Integer("\x00");
  $n = asn1Integer(random_bytes(256));
  $e = asn1Integer("\x01\x00\x01"); // 65537
  $d = asn1Integer(random_bytes(256));
  $p = asn1Integer(random_bytes(128));
  $q = asn1Integer(random_bytes(128));
  $dP = asn1Integer(random_bytes(128));
  $dQ = asn1Integer(random_bytes(128));
  $qInv = asn1Integer(random_bytes(128));

  $seq = $version . $n . $e . $d . $p . $q . $dP . $dQ . $qInv;
  $der = asn1Encode("\x30", $seq);

  $base64 = chunk_split(base64_encode($der), 64, "\n");
  return "-----BEGIN RSA PRIVATE KEY-----\n" .
    rtrim($base64) .
    "\n-----END RSA PRIVATE KEY-----";
}

$fakeKey = generateFakeRsaPrivateKey();
?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <title>Private Key</title>
    <style>
      body {
        background-color: #000;
        color: #0f0;
        font-family: monospace;
        padding: 20px;
      }
      pre {
        font-family: inherit;
        white-space: pre-wrap;
        word-break: break-all;
        margin: 0;
      }
    </style>
  </head>
  <body>
    <pre><?php echo htmlspecialchars($fakeKey, ENT_QUOTES, "UTF-8"); ?></pre>
  </body>
</html>
