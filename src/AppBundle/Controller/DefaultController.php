<?php

namespace AppBundle\Controller;

use AppBundle\Repository\UserJokesRepository;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\Form\JokeForm;
use AppBundle\Services\INCDBService;
use \Symfony\Component\HttpFoundation\Response;

use Swift_Message;
use Swift_Mailer;

use AppBundle\Entity\UserJokes;

class DefaultController extends Controller
{
    /**
     * @Route("/", name="homepage")
     *
     * @param Request $request
     * @return Response
     * @throws \GuzzleHttp\Exception\GuzzleException
     */
    public function indexAction(Request $request, Swift_Mailer $mailer): Response
    {
        $incdb = new INCDBService;
        $categories = $incdb->getCategories();

        $task = ['message' => 'simple form', 'categories' => $categories];
        $form = $this->createForm(JokeForm::class, $task);

        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid())
        {
            $formData = $form->getData();
            $formData['category'] = $categories[$formData['category']];
            $formData['joke'] = $incdb->getJokeFromCategory([$formData['category']]);

            $userJoke = $this->getDoctrine()->getRepository(UserJokes::class)->setUserJoke($formData);
            if (null !== $userJoke->getId()) {
                $message = Swift_Message::newInstance()
                    ->setSubject('Шутка')
                    ->setFrom('test@email.com')
                    ->setTo($userJoke->getUser()->getEmail())
                    ->setBody(
                        $this->renderView('mails/joke.html.twig', array(
                                'text' => 'Случайная шутка из ' . $userJoke->getCategory()->getName()
                            )
                        ),
                        'text/html'
                    );
                $mailer->send($message);
            };
        }

        return $this->render('default/index.html.twig', array(
            'form' => $form->createView(),
        ));
    }
}
