<?php
namespace auth\controllers;

use \Exception;
use base\Controller;
use auth\validators\LoginFieldset;
use auth\validators\RegistrationFieldset;
use profile\models\User;

/**
 * Контроллер авторизации.
 */
class AuthController extends Controller
{
    /**
     * Регистрациия.
     */
    public function registration()
    {
        // $data = $this->request->getBodyJson();
        $data = $this->request->getParams();
        $fieldset = new RegistrationFieldset;
        if (!$fieldset->isValid($data)) {
            $this->sendError(400, $fieldset->errors()->last());
        }
        $values = $fieldset->values;
        $user = User::findByEmail($values['email']);
        if ($user) {
            $this->sendError(403, 'Пользователь с таким email уже существует');
        }
        $values['hash'] = password_hash($values['password'], PASSWORD_DEFAULT);
        $user = User::insert($values);
        Auth::make($user->id);
        $this->sendError(200, 'OK');
    }

    /**
     * Вход.
     */
    public function login()
    {
        // $data = $this->request->getBodyJson();
        $data = $this->request->getParams();
        $fieldset = new LoginFieldset;
        if (!$fieldset->isValid($data)) {
            $this->sendError(400, $fieldset->errors()->last());
        }
        $values = $fieldset->values;
        $user = User::findByEmail($values['email']);
        if (!$user) {
            $this->sendError(404, 'Пользователь с таким email не найден');
        }
        if (!password_verify($values['password'], $user->hash)) {
            $this->sendError(403, 'Неверный email или пароль');
        }
        Auth::make($user->id);
        $this->sendError(200, 'OK');
    }
}
