<?php
// src/Controller/LuckyController.php
namespace App\Controller;

use App\Entity\Cart;
use App\Entity\Expired;
use App\Entity\Item;
use App\Entity\Sales;
use App\Entity\Stock;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use \Doctrine\ORM\Query;
/**
 * @Route("/data")
 */
class DataController extends AbstractController
{
    /**
     * @Route("/all_items")
     * */
    public function items(): Response
    {
        $number = random_int(0, 100);

        // return new Response(
        //     '<html><body>Lucky number: '.$number.'</body></html>'
        // );
        $result = $this->getDoctrine()->getRepository(Item::class)->findAll();
        // dump($result);exit;
        return $this->render('data/all_items.html.twig', [
            'items' => $result,
        ]);
    }

    /**
     * @Route("/all_sales")
     * */
    public function saleslist(): Response
    {
        $result = $this->getDoctrine()->getRepository(Sales::class)->findByDateSold(new \DateTime());
        
        return $this->render('data/all_sales.html.twig', [
            'dailySales' => $result,
        ]);
    }

    /**
     * @Route("/all_stock")
     * */
    public function stock(): Response
    {
        $query = $this->getDoctrine()->getRepository(Stock::class)->createQueryBuilder('s')
                    ->select('s,item,SUM(s.stockQty) as qty')
                    ->join('s.item', 'item')
                    ->groupBy('item')
                    ->getQuery();
        $result = $query->getScalarResult();
        // dump($result);exit;
        return $this->render('data/all_stocks.html.twig', [
            'stocks' => $result,
        ]);
    }

    /**
     * @Route("/all_stocklist")
     * */
    public function stocklist(): Response
    {
        $result = $this->getDoctrine()->getRepository(Stock::class)->getStockList();
        // $result = $query->getScalarResult();
        // dump($result);exit;
        return $this->render('data/all_stocklist.html.twig', [
            'stockList' => $result,
        ]);
    }

    /**
     * @Route("/all_expired")
     * */
    public function expiredlist(): Response
    {

        $result = $this->getDoctrine()->getRepository(Expired::class)->findAll();
        // dump($result);exit;
        return $this->render('data/all_expired.html.twig', [
            'expireds' => $result,
        ]);
    }

    /**
     * @Route("/orders")
     * */
    public function orders(): Response
    {
        $user = $this->getUser();
        $stocks = $this->getDoctrine()->getRepository(Stock::class)->getStockList();
        $cartDatas = $this->getDoctrine()->getRepository(Cart::class)->findByUser($user);
        // dump($result);exit;
        return $this->render('data/order.html.twig', compact('stocks', 'cartDatas'));
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