<?php

namespace San\PlatformBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;

class AdvertController extends Controller
{
    public function indexAction($page)
    {
       
        
        if($page<1){
          throw new NotFoundHttpException('Page "'.$page.'" inexistante.');  
        }
        
        $listAdverts = array(
      array(
        'title'   => 'Recherche développpeur Symfony',
        'id'      => 1,
        'author'  => 'Alexandre',
        'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
        'date'    => new \Datetime()),
      array(
        'title'   => 'Mission de webmaster',
        'id'      => 2,
        'author'  => 'Hugo',
        'content' => 'Nous recherchons un webmaster capable de maintenir notre site internet. Blabla…',
        'date'    => new \Datetime()),
      array(
        'title'   => 'Offre de stage webdesigner',
        'id'      => 3,
        'author'  => 'Mathieu',
        'content' => 'Nous proposons un poste pour webdesigner. Blabla…',
        'date'    => new \Datetime())
    );

        return $this->render('SanPlatformBundle:Advert:index.html.twig', array(
            'listAdverts' => $listAdverts
        ));
    }
    
    public function viewAction($id){
        
        $advert = array(
      'title'   => 'Recherche développpeur Symfony2',
      'id'      => $id,
      'author'  => 'Alexandre',
      'content' => 'Nous recherchons un développeur Symfony2 débutant sur Lyon. Blabla…',
      'date'    => new \Datetime()
    );

    return $this->render('SanPlatformBundle:Advert:view.html.twig', array(
      'advert' => $advert
    ));
    }
    
    public function viewSlugAction($slug, $year, $format){
        return new Response("On pourrait afficher l'annonce correspondant au slug '".$slug."' cree en ".$year." et au format ".$format);
    }
    
    public function addAction(Request $request){
         $antispam = $this->container->get('san_platform.antispam');

    // Je pars du principe que $text contient le texte d'un message quelconque
    $text = '...';
    if ($antispam->isSpam($text)) {
      throw new \Exception('Votre message a été détecté comme spam !');
    }
     
        
        if ($request->isMethod('POST')){
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien enregistree');
            
            return $this->redirectToRoute('san_platform_view', array('id' => 5));
        }
        return $this->render('SanPlatformBundle:Advert:add.html.twig');
    }
    
    public function editAction($id, Request $request){
        if ($request->isMethod('POST')){
            $request->getSession()->getFlashBag()->add('notice', 'Annonce bien modifiée');
            
            return $this->redirectToRoute('san_platform_view', array('id' => 5));
        }
        
         $advert = array(
      'title'   => 'Recherche développpeur Symfony',
      'id'      => $id,
      'author'  => 'Alexandre',
      'content' => 'Nous recherchons un développeur Symfony débutant sur Lyon. Blabla…',
      'date'    => new \Datetime()
    );
         
        return $this->render('SanPlatformBundle:Advert:edit.html.twig', array('advert' => $advert));
    }
    
    public function deleteAction($id)
  {
    return $this->render('SanPlatformBundle:Advert:delete.html.twig');
  }
  
  public function menuAction(){
      $listAdverts = array(
          array('id' => 2, 'title' => 'Recherche développeur Symfony'),
          array('id' => 5, 'title' => 'Mission de webmaster'),
          array('id' => 9, 'title' => 'Offre de stage webdesigner')
      );
      
      return $this->render('SanPlatformBundle:Advert:menu.html.twig', array(
          'listAdverts' => $listAdverts
      ));
  }
}

