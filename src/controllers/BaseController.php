<?php
namespace DomainHomes\Controller;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use JMS\Serializer\SerializerBuilder;

class BaseController {

    protected $serializer;
    protected $repository;
    protected $resource;
    protected $request;
    protected $app;

    public function __construct()
    {
        $serializerClass = new SerializerBuilder();
        $this->serializer = $serializerClass::create()->build();
        $this->request = Request::createFromGlobals();
    }

    public function getElements($criteria = null) 
    {
        return $this->repository->findAll(
            $this->request->get('limit'), 
            $this->request->get('offset'), 
            $this->request->get('orderBy'), 
            $this->request->get('order'),
            $criteria);
    }     

    public function getElement($criteria)
    {
        return $this->repository->findOneBy($criteria);
    }

    public function response($data, $code) 
    {
        $response = new Response(
                $data,
                $code,
                array('content-type' => 'application/json')
            );

        $response->send();
    }

    public function getParameters($parameters = array(), $class)
    {
        $requestedParameters = [];
        $parameters = isset($parameters) ? $parameters : $_GET;
        
        foreach ($parameters as $key => $parameter) {

            $methodName = "get" . ucfirst($key);

            if(method_exists($class, $methodName)){
                $requestedParameters[$key] = $parameter;
            }
        }

        return $requestedParameters;

    }
}