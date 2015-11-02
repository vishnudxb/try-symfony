<?php

namespace AppBundle\Controller;
use AppBundle\Entity\Form;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Process\Process;
use Symfony\Component\Process\Exception\ProcessFailedException;

class MainController extends Controller
{
    /**
     * @Route("/setup", name="setup")
     */
    public function setupAction(Request $request)
    {
      return new JsonResponse(['Github-hook' => ['Build Details' => 'The jenkins will automatically pickup the project change and do the build'], 'url' => 'https://myjenkins/job/try-symfony/'], 200);
    }

    /**
     * @Route("/test", name="test")
     */
    public function testAction(Request $request)

    {
       $form = new Form();

       $form = $this->createFormBuilder($form)
           ->add('Firstname', 'text')
           ->add('Lastname', 'text')
           ->add('Age', 'integer')
           ->add('Save', 'submit')
           ->getForm();

       $form->handleRequest($request);
       if ($form->isValid()) {
           $form = $form->getData();                
           $em = $this->getDoctrine()->getManager();
           $em->persist($form);
           $em->flush();
           return new Response('Form added successfuly');
       }

        return $this->render('default/new.html.twig', array(
            'ourForm' => $form->createView(),
        ));
    }

    /**
     * @Route("/takedown", name="takedown")
     */
    public function takeDownAction(Request $request)
    {                                                                                                                                                                                                       
       $process = new Process('export AWS_CONFIG_FILE=/var/www/aws/config && sh /var/www/takedown.sh');                                                                                                                                                   
       $process->run();                                                                                                                                                                                     
       return new Response('Shutting down Postgres-slave2 instance');
    } 

    /**
     * @Route("/transfer", name="transfer")
     */
    public function transferAction(Request $request)
    {
       $process2 = new Process('cd /var/www && php transfer.php');                                     
       $process2->run();                                                                               
       return new Response('Tranfered data successfuly'); 
    }

    /**
     * @Route("/count", name="count")
     */
    public function countAction(Request $request)
    {
       $process3 = new Process('curl http://remotehostip/output.json');
       $process3->run();                                                
       echo $process3->getOutput();  
    }

    /**
     * @Route("/teardown", name="teardown")
     */
    public function tearDownAction(Request $request)
    {
       $process4 = new Process('export AWS_CONFIG_FILE=/var/www/aws/config && sh /var/www/teardown.sh');                                                                                                                                                   
       $process4->run();                                                                                                                                                                                     
       echo $process4->getOutput();
       return new Response('Shutting down All instances');
    }
}
