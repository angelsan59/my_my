<?php

namespace San\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    public function indexAction()
    {
        return $this->render('SanPlatformBundle:Default:index.html.twig');
    }
}
