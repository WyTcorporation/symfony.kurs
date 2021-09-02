<?php

namespace AppBundle\Controller;

use AppBundle\Form\FeedbackType;
use AppBundle\Service\SerializeProductService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Gregwar\CaptchaBundle\Type\CaptchaType;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction()
    {

        //Сервисы и сервис-контейнеры пример
//        dump($this->container->getParameter('api_key'));
//        dump($this->container->get('doctrine'));

        //Создаем свой сервис-контейнер, смотри папку Service
        //Смотри config/services.yml

//        $product = $this->getDoctrine()->getRepository('AppBundle:Product')->find(1);
//        $serializer = New SerializeProductService();
//        $serializer = $this->container->get('app.serializer');
        //Тоже самое что выше
//        $serializer = $this->get('app.serializer');
//        dump($serializer->serialize($product));


        //end Сервисы и сервис-контейнеры пример

        return $this->render('@App/default/index.html.twig');
    }

    /**
     * @Route("/feedback", name="feedback")
     * @param Request $request
     * @return Response
     */

    public function feedbackAction(Request $request)
    {
        $form = $this->createForm(FeedbackType::class);
        $form->add('captcha', CaptchaType::class, array(
            'width' => 200,
            'height' => 50,
            'length' => 6,
        ));
        $form->add('submit', SubmitType::class);
        $form->handleRequest($request);

        if($form->isSubmitted() && $form->isValid()) {
            $feedback = $form->getData();

            $em = $this->getDoctrine()->getManager();
            //Добавить в поле зрение менеджера (грубо говоря git add)
            $em->persist($feedback);
            //Сохранения (грубо говоря git commit)
            $em->flush();

            //success это идификатор. он может быть любой
            $this->addFlash('success','Saved!!!');

            return $this->redirectToRoute('feedback');

        }

        return $this->render('@App/default/feedback.html.twig', [
            'feedback_form'=> $form->createView()
        ]);
    }

}
