<?php

namespace Application\Controller;

use Zend\Mvc\Controller\AbstractActionController;
use Zend\View\Model\ViewModel;
use Zend\Session\Config\StandardConfig;
use Zend\Session\SessionManager;
use Zend\Session\Container;
use Zend\Http\PhpEnvironment\RemoteAddress;
use Zend\Http\Header\SetCookie;
use Application\Model\Role;
use Zend\Paginator\Paginator;
use Zend\Paginator\Adapter\ArrayAdapter;
use Zend\Db\Adapter\Adapter;

abstract class AbstractAppController extends AbstractActionController
{

    protected $user;
    protected $adapter;
    protected $language;
    protected $previousLink;
    protected $serverTime;
    protected $serverTimezone;

    protected static $instance = null;

    /**
     * @return AbstractAppController
     */
    public static function getInstance()
    {
        return self::$instance;
    }

    public function onDispatch(\Zend\Mvc\MvcEvent $event)
    {
        self::$instance = $this;
        if (!isset($_COOKIE['language'])) {
            $headers = $this->getRequest()->getHeaders();
            $defaultLanguage = 'en';
            $supportedLanguages = array('en', 'pl');
            $match = false;
            $this->setLanguage($defaultLanguage);
            setcookie('language', $this->getLanguage(), time() + (60 * 60 * 24 * 365), '/');
        } else {
            $this->setLanguage($_COOKIE['language']);
            setcookie('language', $this->getLanguage(), time() + (60 * 60 * 24 * 365), '/');
        }
        $referer = $this->getRequest()->getHeader('Referer');
        if ($referer) {
            $referer = $referer->uri()->getPath();
        } else {
            $referer = '/';
        }
        $request = $this->getRequest();
        $response = $this->getResponse();
        if ($request->getHeaders()->get('Cookie') !== false && isset($request->getHeaders()->get('Cookie')->previous_link)) {
            $this->setPreviousLink($request->getHeaders()->get('Cookie')->previous_link);
        } else {
            $cookie = new SetCookie('previous_link', $referer, time() + 3600);
            $response->getHeaders()->addHeader($cookie);
            $this->setPreviousLink($referer);
        }
        parent::onDispatch($event);
    }

    public function renderView($variables = null, $options = null)
    {
    	$variables['session'] = $this->getSession();
    	$variables['prevoiusLink'] = $this->getPreviousLink();
    	return new ViewModel($variables, $options);
    }

    protected function sendMail($user, $title, $content) {
    	$mail = new \Application\Service\MailService();
    	$mail->setTo($user->getEmail())
    	->setSubject($title)
    	->setBody($content)
    	->send();
    }
    //User table checks

    public function getUser()
    {
    	if (empty($this->user)) {
    		$this->setUser();
    	}

    	return $this->user;
    }

    public function setUser()
    {
    	$user = 'guest';
    	$this->getSession()['user_id'];
    	if ($this->getSession()['user_id'] > 0) {
    		$userTable = $this->getServiceLocator()->get('UserTable');
    		$user = $userTable->getOne(array(
    				'aufri_users_id' => $this->getSession()['user_id'],
    		));
    		if (!$user) {
    			return 'guest';
    		}
    		$user->getCleanObject(false);
    	}
    	$this->user = $user;
    	return $this;
    }

    public function isLogin()
    {
    	if ($this->getUser() == 'guest') {
    		return false;
    	} else {
    		return true;
    	}
    }

    public function isAdmin()
    {
    	if (in_array($this->getRole(), array('Admin'))) {
    		return true;
    	} else {
    		return false;
    	}
    }

    public function getPreviousLink()
    {
    	return $this->previousLink;
    }


    public function setPreviousLink($previousLink)
    {
        $this->previousLink = $previousLink;
        setcookie('previous_link', $previousLink, time() + 3600, '/');
        return $this;
    }

    public function getIp()
    {
        $remote = new RemoteAddress();
        return $remote->getIpAddress();
    }

    public function beginDbTransaction()
    {
        $this->getAdapter()->getDriver()->getConnection()->beginTransaction();
    }

    public function commitDbTransaction()
    {
        $this->getAdapter()->getDriver()->getConnection()->commit();
    }

    public function rollbackDbTransaction()
    {
        $this->getAdapter()->getDriver()->getConnection()->rollback();
    }

    public function getAdapter()
    {
        if (empty($this->adapter)) {
            $this->setAdapter($this->getServiceLocator()->get('dbAdapter'));
        }
        return $this->adapter;
    }

    public function setAdapter($adapter)
    {
        $this->adapter = $adapter;
    }

    public function getSession()
    {
        $sessionManager = $this->getSessionManager();
        $sessionManager->start();
        Container::setDefaultManager($sessionManager);
        return new Container('tvp_session');
    }

    public function getSessionManager()
    {
        $config = new StandardConfig();
        $config->setOptions(array(
            'remember_me_seconds' => 1800,
            'name' => 'tvp',
        ));
        return new SessionManager($config);
    }

    public function setErrorMessage($errorMessage, $try_again = FALSE)
    {
        $session = $this->getSession();
        $messages = array();
        if (isset($session['messages_error'])) {
            $messages = $session['messages_error'];
        }

        if ($try_again) {
        	$errorMessage .= " Please try again.";
        }

        array_push($messages, $errorMessage);
        $session['messages_error'] = $messages;
    }

    public function setInfoMessage($infoMessage)
    {
        $session = $this->getSession();
        $messages = array();
        if (isset($session['messages_info'])) {
            $messages = $session['messages_info'];
        }
        array_push($messages, $infoMessage);
        $session['messages_info'] = $messages;
    }

    public function setDefaultMessage($defaultMessage)
    {
        $session = $this->getSession();
        $messages = array();
        if (isset($session['messages_default'])) {
            $messages = $session['messages_default'];
        }
        array_push($messages, $defaultMessage);
        $session['messages_default'] = $messages;
    }

    public function setSuccessMessage($successMessage)
    {
        $session = $this->getSession();
        $messages = array();
        if (isset($session['messages_success'])) {
            $messages = $session['messages_success'];
        }
        array_push($messages, $successMessage);
        $session['messages_success'] = $messages;
    }

    public function objectToArray($object)
    {
        if (is_object($object)) {
            $object = (array) $object;
        }
        if (is_array($object)) {
            $array = array();
            foreach ($object as $key => $value) {
                $array[$key] = $this->objectToArray($value);
            }
        } else {
            $array = $object;
        }
        return $array;
    }

    public function elapsedTime($given_time)
    {
        if (!is_numeric($given_time)) {
            $given_time = strtotime($given_time);
        }

        $currentTime = time();
        $elapsedTime = $currentTime - $given_time;

        if ($elapsedTime < 1) {
            return 'just now';
        }
        $a = array(12 * 30 * 24 * 60 * 60 => 'year',
            30 * 24 * 60 * 60 => 'month',
            24 * 60 * 60 => 'day',
            60 * 60 => 'hour',
            60 => 'minute',
            1 => 'second'
        );
        foreach ($a as $secs => $str) {
            $d = $elapsedTime / $secs;
            if ($d >= 1) {
                $r = round($d);
                return $r . ' ' . $str . ($r > 1 ? 's' : '') . ' ago';
            }
        }
    }

    public function getLocalTimezone()
    {
        if ($this->getUser() != null && $this->getUser() != 'guest') {
            return $this->getUser()->getTimezone();
        } else {
            return 'UTC';
        }
    }

    /**
     * Converts time from PHP server to user local time based on user's timezone
     * @param type $time
     * @return type
     */
    public function getLocalTime($time = null)
    {
        if (empty($time)) {
            $time = $this->getServerTime();
        }
        if (!$this->isLogin()) {
            return $time;
        }
        if ($this->getUser() != null && $this->getUser() != 'guest') {
            $userTimezone = $this->getUser()->getTimezone();
        } else {
            $userTimezone = 'UTC';
        }

        return $this->convertTimeBetweenZones($this->getServerTimezone(), $userTimezone, $time);
    }

    public function convertToUTC($date) {
    	$formattedDate = date("Y-m-d H:i:s", strtotime($date));
    	return $this->convertTimeBetweenZones($this->getLocalTimezone(), 'UTC', $formattedDate);
    }

    public function getLocalTimeAfterSeconds($time)
    {
        $time = intval($time);
        if ($time < 0) {
            $time = -$time;
            $reverse = true;
        }
        $interval = new \DateInterval("PT" . $time . "S");
        $currentTime = \DateTime::createFromFormat('Y-m-d H:i:s', $this->getLocalTime());
        if (isset($reverse)) {
            $modifiedTime = $currentTime->sub($interval);
        } else {
            $modifiedTime = $currentTime->add($interval);
        }

        return $modifiedTime->format('Y-m-d H:i');
    }

    /**
     * Gets SQL server date and time
     * @return type
     */
    public function getServerTime()
    {
        if ($this->serverTime == null) {
            $this->serverTime = $this->getServiceLocator()->get('UserTable')->getServerTime();
        }
        return $this->serverTime;
    }

    public function getServerTimezone()
    {
        if ($this->serverTimezone == null) {
            $this->serverTimezone = $this->getServiceLocator()->get('UserTable')->getServerTimezone();
        }
        return $this->serverTimezone;
    }

    /**
     * Converts time between two timezones. If any of the timezone parameters is null, it is assumed to be server timezone.
     * @param string|null $from Timezone to convert from. If null, it's assumed to be server's timezone.
     * @param string|null $to Timezone to convert to. If null, it's assumed to be server's timezone.
     * @param type $time Date and time to convert. If null, it's assumed to be server's local time.
     * @return type
     */
    public function convertTimeBetweenZones($from, $to, $time = null)
    {
        if ($from == null) {
            $from = $this->getServerTimezone();
        }
        if ($to == null) {
            $to = $this->getServerTimezone();
        }
        if ($time == null) {
            $time = $this->getServerTime();
        }
        $dateTime = new \DateTime($time, new \DateTimeZone($from));
        $dateTime->setTimezone(new \DateTimeZone($to));
        return $dateTime->format('Y-m-d H:i:s');
    }

    public function translate($string)
    {
        $translator = $this->getServiceLocator()->get('translator');
        return $translator->translate($string);
    }
    public function getLanguage()
    {
        return $this->language;
    }

    public function setLanguage($language)
    {
        $this->language = $language;
        return $this;
    }

    public function setLogs($message) {
    	$writerArr = array('stream' => APPLICATION_PUBLIC_PATH . '/logs/error.log', 'mode' => 'a');
    	$writer = new \Zend\Log\Writer\Stream($writerArr);
    	$formatter = new \Zend\Log\Formatter\Simple('%timestamp% %message%' . PHP_EOL);
    	$writer->setFormatter($formatter);
    	$logger = new \Zend\Log\Logger();
    	$logger->addWriter($writer);
    	$logger->info($message);
    }
     /**
     * Function to get pagination
     * @param Object $object contains table object
     * @return OBJECT
     * */

    public function getPagination($object) {
        $paginatorObject = new Paginator(new ArrayAdapter($object));
        // set the current page to what has been passed in query string, or to 1 if none set
        $paginatorObject->setCurrentPageNumber((int) $this->params()->fromQuery('page', 1));
        // set the number of items per page to 10
        $paginatorObject->setItemCountPerPage(9);
        return $paginatorObject;
    }


    public function getPostData() {
        $request = $this->serviceLocator->get('request');
        $nonFile = $request->getPost()->toArray(); // Get form content
        $File = $request->getFiles()->toArray(); // Get form file content
        $data = array_merge_recursive($nonFile, $File);
        return $data;
    }


}
