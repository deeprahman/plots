<?php


namespace Plots\Controllers;
use Plots\Core\Request;

class ErrorController extends AbstractController
{
    public function notFound(): string
    {
        $properties = ['errormessage'=> 'Page Not Found!'];
        return $this->render('error.twig', $properties);
    }
}