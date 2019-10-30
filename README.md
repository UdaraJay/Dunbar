<p align="center"><img src="public/image/dunbar.webp" width="100"></p>
<p align="center">
<h2 align="center">Dunbar</h2>
<h3 align="center">Easy to use (thin) proxy for your Laravel APIs.</h3>

If you're consuming your Laravel API from any public client, like a single-page web app or a mobile/desktop app, chances are you're going to have to store the client-secret credentails somewhere in there. It's super easy for anyone to inspect you code and grab your secure tokens. 

In the event of a leak, resetting your secrets means having to update client code. All-in-all, annoying. 

Using a 'thin' (server-side) proxy is the fastest way to secure your client APIs; simply put, this poxy will sit between your frontend clients and backend apis. Where you would normally make an authentication call to the API with a client-id and client-secret like so:

```http
POST /auth HTTP/1.1
Host: api.example.com

grant_type=password
&client_id=webapp
&client_secret=a-secret-code-no-one-should-see
&username=admin
&password=password
```

You'd now be making the same API call to the proxy endpoint, in our case `example.com/dunbar`, **minus the client-secret**. The proxy will take the request, add the client-secret and forward the request to your backend API. 

The server would **normally** respond with the access tokens and refresh tokens like so:

```json
{
    "access_token": "DDSHs55zpG51Mtxnt6H8vwn5fVJ230dF",
    "refresh_token": "24QmIt2aV1ubaenB2D6G0se5pFRk4W05",
    "token_type": "Bearer",
    "expires": 1415741799
}
```

But with our thin proxy, it'll simply create an encrypted cookies that only the proxy and decrypt. That's it. Simple.

Now, for all future call to the API: 
```http
GET /ajax/resource/123 HTTP/1.1
Cookie: <encrypted cookie with tokens>
Host: example.com
```

The `proxy` will decrypt the cookie, add the Authorization header to the request and forward it on to the API like so:

```http
GET /resource/some-protected-resource HTTP/1.1
Authorization: Bearer the-access-token-form-the-cookie
Host: api.example.com
```

The responses will be passed direclly back to the browser or app exactly like you define in your API.


### So what exactly does this "thin" proxy do?
Simply put, the proxy lets you hard code the client-secret credentials into this thin server-side component (proxy) that you can trust. It authenticates your client APIs for you and returns an encrypted cookies with the user credentials (eg. access token) that only the proxy can decrypt. All you need to do to access protected resources after you've authenticated via the proxy is to pass this cookie with all your calls. 

### What more? 
Teh further secure your API, you can lock it down to only accept requests from the proxy. Additionally you can also roll your client-secret on a schedule or anytime you need to without having to update any front-end clients. 

## Installation

1. Install `Dunbar` via composer

```
composer require UdaraJay/Dunbar
```
2. Publish the configuration
```
php artisan vendor:publish
```

3. Edit the file `app/config/dunbar.php` to suit your needs. Primarily you can edit it to change the name of the cookie and the proxy endpoint.

You may also need to regenrate your route and config cache on Laravel using `php artisan config:clear` and `php artisan route:cache`.

## Usage

The package will automatically register a proxy endpoint (default being `yourdomain.com/dunbar`). Make all your API calls to the proxy endpoint like so to authenticate: 

```http
POST dunbar/example.com/oauth/token HTTP/1.1
Host: example.com

&grant_type=password
&client_id=webapp
&username=admin
&password=mypassword
```

And requests to all protected resources like so:

```http
POST dunbar/example.com/protected_resource HTTP/1.1
Host: example.com
```

If the `access_token` expires and you have got a `refresh_token`, `Dunbar` will call the OAuth server for you and refresh the `access_token` with a new one and update the cookie.

## Features
* Dead-simple proxy for securing your Laravel API. Works seamlessly with Passport or the League OAuth2 server that is maintained by Andy Millington and Simon Hamp.
* [ Upcoming] Interact with database (Passport defaults first), to access client secrets directly from the OAuth provider.
* [ Upcoming] Auto-roll client secrets on a schedule.

## Questions? 
Create an issue and tag it with `question`. I'll try to help & answer best I can. 

## Contribute? 
Please do :). Just create a PR.

## License & Credits

This package is released under the MIT License. 
