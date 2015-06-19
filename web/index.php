<?php
    require '../vendor/autoload.php';
    require '../src/config/parameters.php';
    
    $app = new \Slim\Slim([
        'mode' => APPLICATION_MODE,
        'debug' => true
    ]);

    /**
     * @todo  A more advanced form of authentication
     */
    $app->hook('slim.before', function () use ($app){

        $api_key = "WHATEVERYOUWANT";
        $serializerClass = new JMS\Serializer\SerializerBuilder();
        $serializer = $serializerClass::create()->build();
        
        if ($app->request->headers->get('Authorization') !== $api_key) {

            $response = new Symfony\Component\HttpFoundation\Response(
                $serializer->serialize("invalid authorization key", 'json'),
                Symfony\Component\HttpFoundation\Response::HTTP_UNAUTHORIZED,
                [
                    'content-type' => 'application/json'
                ]
            );

            $response->send();
            exit;
        }
    });

    

    /***********
    ***ROUTES***
    ***********/
    $app->get('/units/:unitCode', 'Skeleton\Controller\OperatingUnitController:getOperatingUnit');
    $app->get('/units', 'Skeleton\Controller\OperatingUnitController:getOperatingUnits');

    $app->get('/lots/:id', 'Skeleton\Controller\LotController:getLot');
    $app->get('/lots', 'Skeleton\Controller\LotController:getLots');
    $app->get('/lots/projects/:id', 'Skeleton\Controller\LotController:getLotsByProject');

    $app->get('/models/:id', 'Skeleton\Controller\ModelController:getModel');
    $app->get('/models', 'Skeleton\Controller\ModelController:getModels');

    $app->get('/products/:id', 'Skeleton\Controller\ProductController:getProduct');
    $app->get('/products', 'Skeleton\Controller\ProductController:getProducts');  
    
    $app->get('/projects/:id', 'Skeleton\Controller\ProjectController:getProject');
    $app->get('/projects', 'Skeleton\Controller\ProjectController:getProjects');

    $app->run();






