<?php

namespace App\Controller;

use Psr\Log\LoggerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use App\Service\MessageGenerator;
class SMSController extends Controller
{
    /**
     * @Route("/sms/number/{max}", name="sms")
     */
    public function number($max, LoggerInterface $logger){
		$number = mt_rand(0, 100);
    	$logger->info('The lucky number is: '.$number);
        return $this->render('sms/number.html.twig', array(
            'number' => $number,
        ));
	}

    /**
     * @Route("/happy/message", name="happy_message")
     */
	public function msgGen(MessageGenerator $messageGenerator){
		$message = $messageGenerator->getHappyMessage();
		$this->addFlash('success', $message);
        return $this->render('sms/happy.html.twig', array(
            'message' => $message,
        ));
	}
}
