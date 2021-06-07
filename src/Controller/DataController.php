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
use Symfony\Component\HttpFoundation\JsonResponse;

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

    /**
     * @Route("/add_cart")
     * */
    public function addCart(): Response
    {
        if(isset($_POST['stock_id'])){
            $stock_id = $_POST['stock_id'];
            $item_id = $_POST['item_id'];
            $cqty = $_POST['cqty'];//cart qty ni siya
            $user_id = $_SESSION['logged_id'];
            $nqty = $_POST['nqty'];//cart qty ni siya
            $uniqid = $_SESSION['uniqid'];
            //add to cart
            $entityManager = $this->getDoctrine()->getManager();
            $item = $entityManager->getRepository(Item::class)->find($item_id);
            $stock = $entityManager->getRepository(Stock::class)->find($stock_id);
                $cart = new Cart();
                $cart->setItem($item);
                $cart->setCartQty($cqty);
                $cart->setCartStockId($stock_id);
                $cart->setUser($this->getUser());
                $cart->setCartUniqid($uniqid);
                // tell Doctrine you want to (eventually) save the Product (no queries yet)
                $entityManager->persist($cart);

                $stock->setStockQty($cqty);
                // actually executes the queries (i.e. the INSERT query)
                $entityManager->flush();

            //update stock og minus si sa cart qty
            // $updateStockQty = $stock->update_stockQty($stock_id, $nqty);
        
        }//end isset

        return new Response(
            'success'
        );
        // return $this->render('admin/number.html.twig', [
        //     'number' => $number,
        // ]);
    }

    /**
     * @Route("/del_cart")
     * */
    public function deleteCart(): Response
    {
        if(isset($_POST['stock_id'])){
            $stock_id = $_POST['stock_id'];
            $cart_id = $_POST['cart_id'];
            $qty = $_POST['qty'];
        
            //add to cart
            $entityManager = $this->getDoctrine()->getManager();
            $cart = $entityManager->getRepository(Cart::class)->find($cart_id);
            $stock = $entityManager->getRepository(Stock::class)->find($stock_id);
            $currentQty = $stock->getStockQty();
            $qty += $currentQty;

            $stock->setStockQty($qty);

            $entityManager->persist($stock);

            $entityManager->remove($cart);
                

            // actually executes the queries (i.e. the INSERT query)
            $entityManager->flush();

        }//end isset

        return new Response(
            'success'
        );
    }
    /**
     * @Route("/confirm_order")
     * */
    public function confirmOder(): Response
    {

        $entityManager = $this->getDoctrine()->getManager();
        if(isset($_POST['click'])){
            if($_POST['click'] == 'yes'){
                //select cart details
                $cartDetails = $entityManager->getRepository(Cart::class)->findAll();
            
                foreach ($cartDetails as $cd) {
                    // $insertSale = $sales->new_sales($code,$generic,$brand,$gram,$type,$cartQty,$price);
                    $sales = new Sales();
                    $sales->setItemCode($cd->getItem()->getItemCode());
                    $sales->setGenericName($cd->getItem()->getItemName());
                    $sales->setBrand($cd->getItem()->getItemBrand());
                    $sales->setGram($cd->getItem()->getItemGrams());
                    $sales->setType($cd->getItem()->getItemType()->getItemTypeDesc());
                    $sales->setQty($cd->getCartQty());
                    $sales->setPrice($cd->getItem()->getItemPrice());

                    $entityManager->persist($sales);
                    $entityManager->remove($cd);
                    //insert to sales
                }//end foreach
        
                //del all cart
                // $delAllCart = $cart->dellAllCart();
                try {
                    $entityManager->flush();
                    $return['valid'] = true;
                    $return['msg'] = 'Transaction ajouté avec succés!';
                    return new JsonResponse(
                        $return
                    );
                } catch (\Exception $th) {
                    //throw $th;
                }
            }//end yes
        }//end isset
    
        return new JsonResponse(
            ['valid' => 'false']
        );
    }

    
}