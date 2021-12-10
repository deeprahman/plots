<?php


namespace Plots\Controllers;
use Plots\Core\Request;

class ErrorController extends AbstractController
{

    /**
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @throws \Twig\Error\LoaderError
     */
    public function notFound(): string
    {
        $this->properties = [
            'message'=> 'Page Not Found!'
        ];
        return $this->render('error.twig', $this->properties);
    }

    /**
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\SyntaxError
     * @throws \Twig\Error\LoaderError
     */
    public function invalidPath():string{
        $this->properties = [

            'message'=> 'Page Not Found!'
        ];
        return $this->render('error.twig', $this->properties);
    }

    public function notAllowed(){
        $this->properties = [

            'message'=> 'Login Required'
        ];
        return $this->render('error.twig', $this->properties);
    }
}