<?php


namespace Plots\Controllers;
use Plots\Core\Request;

class ErrorController extends AbstractController
{
    public function __construct(Request $request){

    }

    public function notFound(){
        // TODO: write body
        $res = "Method not found";
        return $res;
    }
}