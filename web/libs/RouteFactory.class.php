<?php

class RouteFactory {

    protected static $_routes = [];

    protected static $_middlewares;

    protected $routes = [];

    protected $rout2;
    
    protected $middlewares;

    protected $templates;

    protected $dispatcher;

    protected $routeInfo;

    protected $language;

    protected $uri;

    protected $httpMethod;


    public function __construct( \League\Plates\Engine $templates, Language $language)
    {

//        $this->routes = $routes;

        $this->middlewares = self::$_middlewares;

        $this->routes = self::$_routes;

        $this->templates = $templates;

        $this->language = $language;

        $this->dispatcher = FastRoute\simpleDispatcher(function(FastRoute\RouteCollector $r) {

            $mylanguages = Config::get('supportedLanguages');

            $mylanguagesstr = '';

            if($mylanguages>0) {

                foreach ($mylanguages AS $key => $val) {

                    if (($key = array_search(Config::get('defaultLanguage'), $mylanguages)) !== false) {

                        unset($mylanguages[$key]);

                    }

                }

            }

            if(count($mylanguages)>0) {

                $mylanguagesstr = implode('|', $mylanguages);

            }

            foreach ($this->routes as $route) {

                $r->addRoute($route->method, $route->pattern, $route->handler);

                if( $mylanguagesstr != '' ){
                    $route->pattern = ($route->pattern == '/') ? '' : $route->pattern;
                    $r->addRoute($route->method, '/{lang: '.$mylanguagesstr.'}' . $route->pattern, $route->handler);

                }



            }

            //$r->addRoute('GET', '/users', 'get_all_users_handler');

        });

        // Fetch method and URI from somewhere
        $this->httpMethod = $_SERVER['REQUEST_METHOD'];
        $uri = parse_url($_SERVER['REQUEST_URI'], PHP_URL_PATH);
        $uri =  ( strlen($uri) > 1 ) ? rtrim($uri, '/') : $uri;

        $this->uri = $uri;



        $this->routeInfo = $this->dispatcher->dispatch($this->httpMethod, $this->uri);

    }
    
    public static function route($method, $routePattern, $handler, $middlewares = [])
    {

        $route = new stdClass();

        $route->method = $method;
        $route->pattern = $routePattern;
        $route->handler = $handler;
        $route->middlewares = $middlewares;

        self::$_routes[] = $route;

    }

    public function getResponse()
    {

        switch ($this->routeInfo[0]) {

            case FastRoute\Dispatcher::NOT_FOUND :
                // ... 404 Not Found

                http_response_code(404);

                // Render a template
                echo $this->templates->render('errors/404');

                break;

            case FastRoute\Dispatcher::METHOD_NOT_ALLOWED :
                $allowedMethods = $this->routeInfo[1];
                // ... 405 Method Not Allowed

                http_response_code(405);
                // Render a template
                echo $this->templates->render('errors/405');

                break;

            case FastRoute\Dispatcher::FOUND :

                $handler = $this->routeInfo[1];
                $vars = $this->routeInfo[2];

                $direction = explode('@', $handler);

                if ( array_key_exists(1, $direction) ) {

                    // instantiate the controller which is responsible for the route
                    return $this->callAction($direction[0], $direction[1], $vars);

                }elseif  ( file_exists($handler) ) {

                    // require the file which is responsible for the route
                    require ($handler);

                    exit();

                }

                throw new Exception("No handler was found for requested uri: {$this->uri}!");

                // ... call $handler with $vars
                break;

            default :

                throw new Exception("uri does not exist {$this->uri}");

                // ... call $handler with $vars
                break;

        }

        return null;
    }


    protected function callAction($controller, $action, $params = array())
    {

        if ( !method_exists($controller, $action) ) {

            throw new Exception("{$controller} does not correspond to method: {$action}");

        }

        return (new $controller($this->templates, $this->language))->$action($params);

    }
    
}