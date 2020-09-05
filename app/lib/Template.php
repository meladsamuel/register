<?php


namespace app\lib;


class Template
{
    private $_View;
    private SessionManager $session;
    private array $data;


    public function setData($data)
    {
        $this->data = $data;
    }


    public function setSession($session)
    {
        $this->session = $session;
    }


    public function templateHeader($SRC)
    {
        extract($this->data);
        require TEMPLATE_PATH . 'header.php';
        $output = '';
        foreach ($SRC as $value)
            $output .= "\t<link rel='stylesheet' href='{$value}'>\n";
        echo $output;
    }


    public function templateFooter()
    {
        $output = '';
        foreach ($this->_template['footer_resources'] as $key => $value) {
            $output .= "<script  src='" . $value . "'></script>\n ";
        }
        echo $output;
        require TEMPLATE_PATH . 'templateFooter.php';
    }

    private function templateBlocks()
    {
        extract($this->data);
        foreach ($this->_template['template'] as $key => $value) {
            if ($key == ':view')
                require $this->_actionView;
            else
                require $value;
        }
    }

    public function appRender($isAjax)
    {

        $this->templateHeader();
        $this->templateBlocks();
        $this->templateFooter();
    }


}