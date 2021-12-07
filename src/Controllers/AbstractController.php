<?php


namespace Plots\Controllers;
use Plots\Core\Request;

abstract class AbstractController
{
    public abstract function __construct(Request $request);
}