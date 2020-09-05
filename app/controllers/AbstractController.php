<?php


namespace app\controllers;


use app\lib\Messenger;
use app\lib\SessionManager;

class AbstractController
{
    protected string $_method;
    protected SessionManager $session;
    public Messenger $messenger;

    /**
     * @param $session
     * @return bool
     */
    public function isAuthorized($session)
    {
        return $this->_method == 'register' || isset($session->user) ? true : false;
    }

    protected function templateHeader($SRC)
    {
        $title = isset($this->data['title']) ? $this->data['title'] : 'LoginSys';
        require TEMPLATE_PATH . 'headerStart.php';
        $output = '';
        foreach ($SRC as $value)
            $output .= "\t<link rel='stylesheet' href='" . WEB_SITE_NAME . '/' . $value . "'>\n";
        echo $output;
        require TEMPLATE_PATH . 'headerEnd.php';

    }

    protected function templateFooter(array $SRC)
    {
        require TEMPLATE_PATH . 'footerStart.php';
        $output = '';
        foreach ($SRC as $value) {
            $output .= "<script  src='" . WEB_SITE_NAME . '/' . $value . "'></script>\n ";
        }
        echo $output;
        require TEMPLATE_PATH . 'footerEnd.php';
    }

    protected function templateBlocks(string $views, SessionManager $session, array $msg)
    {
        extract($this->data);
        if ($this->isAuthorized($session)) {
            $file = VIEWS_PATH . $views . '.view.php';
            if (file_exists($file))
                require $file;
            else
                require VIEWS_PATH . 'notfound' . DS . 'notfound.view.php';
        } else {
            require VIEWS_PATH . 'user' . DS . 'login.view.php';
        }


    }

    protected function view(string $views, array $msg = [], array $cssFiles = [], array $jsFiles = [])
    {
//        var_dump($this->messenger);
        if (strpos($views, '@') !== false)
            $views = str_replace('@', DS, $views);
        $this->templateHeader($cssFiles);
        $this->templateBlocks($views, $this->session, $msg);
        $this->templateFooter($jsFiles);
    }

}