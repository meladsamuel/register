<?php

namespace app\controllers;

use app\lib\Helper;
use app\lib\InputFilter;
use app\lib\Messenger;
use app\lib\SessionManager;
use app\lib\validate;
use app\models\UsersModel;

class Users extends AbstractController
{
    use InputFilter;
    use validate;
    use Helper;
    protected array $registerRole = [
        'firstName' => 'req|alpha',
        'lastName' => 'req|alpha',
        'email' => 'req|email',
        'password' => 'req',
        'phone' => 'req|int',
        'address' => 'req|alphanum'
    ];

    public function __construct(SessionManager $session, Messenger $messenger, string $method)
    {
        $this->session = $session;
        $this->messenger = $messenger;
        $this->_method = $method;
    }
    public function index() {
        $this->redirect('/profile');
    }

    public function login()
    {
        if ($this->session->user)
            $this->redirect('/profile');

        if (isset($_POST['login'])) {
            $user = UsersModel::authenticate($_POST['email'], $_POST['password'], $this->session);
            if ($user) {
                $this->messenger->add("User login ins successfully");
                $this->redirect('/profile');
            }
        }
        $this->view('user@login', ['css/style.css']);
    }

    public function logout() {
        unset($this->session->user);
        $this->redirect('/');
    }

    public function register()
    {
        if ($this->session->user)
            $this->redirect('/profile');
        $hasError = false;
        if (isset($_POST['login']) && $this->isValid($this->registerRole, $_POST)) {
            if (UsersModel::userExisting($this->filterString($_POST['email']))) {
                $this->messenger->add("the email already exist in our records", Messenger::APP_MESSAGE_ERROR);
                $hasError = true;
            }
            if (!$hasError) {
                $user = new UsersModel();
                $user->firstName = $this->filterString($_POST['firstName']);
                $user->lastName = $this->filterString($_POST['lastName']);
                $user->email = $this->filterString($_POST['email']);
                $user->cryptPassword($_POST['password']);
                $user->phone = $this->filterString($_POST['phone']);
                $user->address = $this->filterString($_POST['address']);
                if ($user->save()) {
                    $this->messenger->add("User save successfully");
                    $this->session->user = $user;
                    $this->redirect('/profile');
                }
            }
        }

        $this->view('user@register');
    }

    public function profile()
    {
        if (!isset($this->session->user))
            $this->redirect('/login');
        $this->data['title'] = $this->session->user->firstName . ' Profile';
        $this->data['user'] = $this->session->user->firstName . ' ' . $this->session->user->lastName;
        $this->view('user@profile');
    }



}