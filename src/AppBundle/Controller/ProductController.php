<?php


namespace AppBundle\Controller;

use AppBundle\Entity\Category;
use AppBundle\Entity\Product;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Template;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends Controller
{

    /**
     * @Route("/products", name="product_list")
     * @Template()
     */
    public function indexAction()
    {
//        $products = $this->getDoctrine()->getRepository('AppBundle:Product')->findAll();

        $products = $this->getDoctrine()->getRepository('AppBundle:Product')->findActive();

//        Используем шаблон что бы убрать лишние строки !!! Название контроллера/папки и экшена должны совпадать
        return ['products' => $products];

//        return $this->render('@App/product/index.html.twig',
//            [
//                'products' => $products
//            ]
//        );
    }

    //@Route("/products/{slug}", name="product_show")
    /**
     * @Route("/products/{id}", name="product_show" , requirements={"id":"[0-9]+"})
     * @Template()
     * @param $id
     * @return array
     */

//    public function showAction($id)
//
////    public function showAction($slug)
//
////    public function showAction(Request $request)
//    {
////        dump($request->get('id'));
//
//        $product = $this->getDoctrine()->getRepository('AppBundle:Product')->find($id);
//
//        if (!$product) {
//            throw $this->createNotFoundException('Product not found!');
//        }
////        Используем шаблон что бы убрать лишние строки !!! Название контроллера/папки и экшена должны совпадать
//        return [ 'product'=>$product ];
//
////        return $this->render('@App/product/show.html.twig',[
////            'id'=>$id
////        ]);
//    }

    /**
     * @Route("/products/{id}", name="product_show" , requirements={"id":"[0-9]+"})
     * @Template()
     * @param Product $product
     * @return array
     */

    //Если логика простая то можно прописать так

    public function showAction(Product $product)
    {
        return [ 'product'=>$product ];
    }

    /**
     * @Route("/category/{id}", name="list_by_category" , requirements={"id":"[0-9]+"})
     * @Template()
     * @param  Category $category
     * @return array
     */
    public function listByCategoryAction(Category $category)
    {
        $products = $this->getDoctrine()->getRepository('AppBundle:Product')->findByCategory($category);

        return [ 'products'=>$products ];
    }

}