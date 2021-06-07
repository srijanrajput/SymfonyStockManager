<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class AdminController extends AbstractController
{
    /**
     * @Route("/home")
     * */
    public function home(): Response
    {
        return $this->render('admin/home.html.twig');
    }

    /**
     * @Route("/item")
     **/
    public function item(): Response
    {
        return $this->render('admin/item.html.twig');
    }

    
    /**
     * @Route("/product")
     **/
    public function product(): Response
    {
        return $this->render('admin/product.html.twig');
    }

    /**
     * @Route("/stock")
     **/
    public function stock(): Response
    {
        return $this->render('admin/stock.html.twig');
    }

        /**
     * @Route("/expired")
     **/
    public function expired(): Response
    {
        return $this->render('admin/expired.html.twig');
    }

        /**
     * @Route("/sales")
     **/
    public function sales(): Response
    {
        return $this->render('admin/sales.html.twig');
    }

    /**
     * @Route("/admin")
     * */
    public function test(): Response
    {
        $number = random_int(0, 100);

        return new Response(
            '<html><body>Lucky number: '.$number.'</body></html>'
        );
        // return $this->render('admin/number.html.twig', [
        //     'number' => $number,
        // ]);
    }
}