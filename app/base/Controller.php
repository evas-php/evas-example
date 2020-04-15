<?php
namespace base;

use Evas\Web\Controller as WebController;

/**
 * Базовый класс контроллера приложения.
 */
class Controller extends WebController
{
    /**
     * Отправка ошибки.
     * @param int|null код статуса
     * @param string|null текст ошибки
     * @param array|null заголовки
     */
    public function sendError(int $code, string $message, array $headers = null)
    {
        $this->response->send($code, $message, $headers);
        exit();
    }
}
