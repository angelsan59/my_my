<?php

namespace San\CoreBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;

class CoreController extends Controller
{
    public function indexAction()
    {
  
        return $this->render('SanCoreBundle:Core:index.html.twig');
        
    }
    
    public function contactAction(Request $request)
  {
     if ($request->isMethod('GET')){    
            $session = $request->getSession();
    $session->getFlashBag()->add('info', 'Message flash : La page de contact n\'est pas encore disponible. Merci de revenir plus tard.');
            
            return $this->redirectToRoute('san_core_homepage');
        }
        return $this->render('SanCoreBundle:Core:contact.html.twig');
    }
    
    
  
}
