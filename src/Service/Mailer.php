<?php

namespace App\Service;


use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

class Mailer
{
    /**
     * @var \Swift_Mailer
     */
    private $mailer;

    /**
     * @var \Twig_Environment
     */
    private $twig;

    /**
     * @var string
     */
    private $senderEmail;

    public function __construct(\Swift_Mailer $mailer, \Twig_Environment $twig, ParameterBagInterface $parameterBag) {
        $this->mailer = $mailer;
        $this->twig = $twig;
        $this->senderEmail = $parameterBag->get('sender_email');

    }

    /**
     * @param $to
     * @param $temlateName
     * @param array $params
     * @throws \Throwable
     * @throws \Twig_Error_Loader
     * @throws \Twig_Error_Runtime
     * @throws \Twig_Error_Syntax
     */
    public function send($to, $temlateName, array $params = []) {
        $params = $this->twig->mergeGlobals($params);
        $temlate = $this->twig->load($temlateName);
        $subject = $temlate->renderBlock('subject', $params);
        $body = $temlate->renderBlock('body', $params);

        $message = new \Swift_Message();
        $message->addFrom($this->senderEmail);
        $message->addTo($to);
        $message->setSubject($subject);
        $message->setBody($body);

        $this->mailer->send($message);
    }
}