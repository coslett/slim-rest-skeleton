<?php
    require '../vendor/autoload.php';
    require '../src/config/parameters.php';
    
    $app = new \Slim\Slim([
        'mode' => APPLICATION_MODE,
        'debug' => true
    ]);

    /**
     * @todo  Convert to OAuth
     *
     * I do not recommend using this as your authentication method
     * but it is a way that you can for the time being protect
     * your API (though request from JavaScript would show the key)
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
    $app->get('/skeleton/:id', 'Skeleton\Controller\SkeletonController:getSkeleton');
    $app->get('/skeleton', 'Skeleton\Controller\SkeletonController:getSkeletons');

    $app->run();






