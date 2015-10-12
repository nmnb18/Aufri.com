<?php

namespace Application\Service;

use Zend\Mail\Message;
use Zend\Mail\Transport\Smtp;
use Zend\Mail\Transport\SmtpOptions;
use Zend\Mime\Message as MimeMessage;
use Zend\Mime\Part as MimePart;

class MailService
{

    public $to;
    public $subject;
    public $body;

    public function send()
    {
        $smtpOptions = new SmtpOptions(array(
            'name' => 'smtp.gmail.com',
            'host' => 'smtp.gmail.com',
            'connection_class' => 'login',
            'connection_config' => array(
                'username' => 'naman.bakliwal@optimusinfo.com',
                'password' => 'optimus@123',
                'port' => 465,
                'ssl' => 'TLS'
            ),
        ));

        $html = new MimePart($this->getBody());
        $html->type = "text/html";
        $body = new MimeMessage();
        $body->setParts(array($html));
        $mailTransport = new Smtp();
        $mailTransport->setOptions($smtpOptions);
        $mail = new Message();
        $mail->addFrom('naman.bakliwal@optimusinfo.com', 'Travelopod')
                ->setEncoding('utf-8')
                ->setTo($this->getTo())
                ->setSubject($this->getSubject())
                ->setBody($body);
        $send = $mailTransport->send($mail);
        $mailTransport->disconnect();
    }

    public function getTo()
    {
        return $this->to;
    }

    public function getSubject()
    {
        return $this->subject;
    }

    public function getBody()
    {
        return $this->body;
    }

    public function setTo($to)
    {
        $this->to = $to;
        return $this;
    }

    public function setSubject($subject)
    {
        $this->subject = $subject;
        return $this;
    }

    public function setBody($body)
    {
        $this->body = $body;
        return $this;
    }

}
