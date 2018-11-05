<?php

namespace MerchantTransactionsBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;

class DefaultController extends Controller
{
    /**
     * @Route("/")
     */
    public function indexAction()
    {
        return $this->render('MerchantTransactionsBundle:Default:index.html.twig');
    }
}
