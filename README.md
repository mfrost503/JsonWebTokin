# JsonWebTokin

Tokin some webs

## Description:

This is small library that can be used to verify JSON Web Tokens. There are 2 classes that are 
used in this library `JsonWebToken` and `Verifier`, the `JsonWebToken` class allows to segment the pieces
of the token out so they can be easily generated/derived.

To use the `Verifier`, all you will need is a `JsonWebToken` instance, as well as the key that was used to sign
token (in a lot of cases this will be your Client Secret).

## Examples

### Verifying a JWT

```php
use Tokin\JWT\JsonWebToken;
use Tokin\JWT\Verifier;

$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEyMzM0NjQ2NCIsImZpcnN0X25hbWUiOiJUZXN0IiwibGFzdF9uYW1lIjoiTWNUZXN0ZXJzb24iLCJlbWFpbCI6InRlc3RAdGVzdC5jb20iLCJleHBpcmVzIjoxMjMyMTQyfQ.7BHgbsBAyK0IRDKPtFOhHKFYta6_fdujngX64zMYrtg';
$key = 'abcdefghijklmno';

$verifier = new Verifier();
$jwt = new JsonWebToken($token);

return $verifier->verify($jwt, $key); // returns a boolean
```

### Retrieving Header Info From JWT

```php
use Tokin\JWT\JsonWebToken;

$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEyMzM0NjQ2NCIsImZpcnN0X25hbWUiOiJUZXN0IiwibGFzdF9uYW1lIjoiTWNUZXN0ZXJzb24iLCJlbWFpbCI6InRlc3RAdGVzdC5jb20iLCJleHBpcmVzIjoxMjMyMTQyfQ.7BHgbsBAyK0IRDKPtFOhHKFYta6_fdujngX64zMYrtg';

$jwt = new JsonWebToken($token);

$headers = $jwt->getHeader(true); // this will return the JSON for the header, false will return the Base 64 URL Encoded value

// {"typ": "JWT", "alg":"HS256"}
```

### Retrieving the Payload Info From JWT

```php

use Tokin\JWT\JsonWebToken;

$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEyMzM0NjQ2NCIsImZpcnN0X25hbWUiOiJUZXN0IiwibGFzdF9uYW1lIjoiTWNUZXN0ZXJzb24iLCJlbWFpbCI6InRlc3RAdGVzdC5jb20iLCJleHBpcmVzIjoxMjMyMTQyfQ.7BHgbsBAyK0IRDKPtFOhHKFYta6_fdujngX64zMYrtg';

$jwt = new JsonWebToken($token);

$payload = $jwt->getPayload(true); // this will return the JSON for the header, false will return the Base 64 URL Encoded value
```

### Retrieving the Signature From JWT

```php
use Tokin\JWT\JsonWebToken;

$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEyMzM0NjQ2NCIsImZpcnN0X25hbWUiOiJUZXN0IiwibGFzdF9uYW1lIjoiTWNUZXN0ZXJzb24iLCJlbWFpbCI6InRlc3RAdGVzdC5jb20iLCJleHBpcmVzIjoxMjMyMTQyfQ.7BHgbsBAyK0IRDKPtFOhHKFYta6_fdujngX64zMYrtg';

$jwt = new JsonWebToken($token);

$signature = $jwt->getSignature();
```

### Retrieving the Original JWT

```php
use Tokin\JWT\JsonWebToken;

$token = 'eyJ0eXAiOiJKV1QiLCJhbGciOiJIUzI1NiJ9.eyJpZCI6IjEyMzM0NjQ2NCIsImZpcnN0X25hbWUiOiJUZXN0IiwibGFzdF9uYW1lIjoiTWNUZXN0ZXJzb24iLCJlbWFpbCI6InRlc3RAdGVzdC5jb20iLCJleHBpcmVzIjoxMjMyMTQyfQ.7BHgbsBAyK0IRDKPtFOhHKFYta6_fdujngX64zMYrtg';

$jwt = new JsonWebToken($token);

$token = $jwt->getOriginalToken();
```
