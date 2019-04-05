# Pass Through Basic Authentication


A Decorator for HttpBasicAuthentication that passes through any user with password and make it available
to the controller (e.g. to be reused for Proxy-API's).

It is based on [HttpBasicAuthentication](https://github.com/tuupola/slim-basic-auth). Any parameters, that the constructor of HttpBasicAuthentication excepts,
can be passed to PassThroughHttpBasicAuthentication also.
 
## Example:
 
 
```
use itinance\Middleware\PassThroughHttpBasicAuthentication

$app = new \Slim\App($config);

$app->add(new PassThroughHttpBasicAuthentication([
    "realm" => "Protected",
]));

// Define app routes
$app->post('/soapProxy/{methodName}', function (\Slim\Http\Request $request, \Slim\Http\Response $response, $args) {

    $user = $params['PHP_AUTH_USER'];
    $pass = $params['PHP_AUTH_PW'];

    // Proxy-Call to another API with Username and Password happens here
    // ...proxyCall($user, $pass, ...)
});

// Run app
$app->run();

```

