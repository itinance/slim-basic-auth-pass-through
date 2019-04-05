# Pass Through Basic Authentication


A Decorator for HttpBasicAuthentication that passes through any user with password and make it available
to the controller (e.g. to be reused for Proxy-API's)
 
## Example:
 
 
```
$app = new \Slim\App($config);

$app->add(new \ProxyAPI\middleware\PassThroughHttpBasicAuthentication([
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

