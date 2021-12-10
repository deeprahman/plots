<?php


namespace Plots\Controllers;

class HomeController extends AbstractController
{
    /**
     * @throws \Twig\Error\SyntaxError
     * @throws \Twig\Error\RuntimeError
     * @throws \Twig\Error\LoaderError
     */
    public function homePage(){
        $this->properties = [
            'message'=> 'Home  page'
        ];
        return $this->render('home.twig', $this->properties);
    }
}