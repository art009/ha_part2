<?php

namespace app\common;

use app\entities\User;
use app\interfaces\IController;
use app\services\UserService;
use Exception;
use PDO;
use Throwable;

class Controller implements IController
{
    public string $layout = 'main.php';
    public ?User $user = null;

    public function __construct(
        private readonly ?PDO $db = null
    ) {
        $this->user = (new UserService($this->db) )->getUser();
    }

    public function getDb(): PDO
    {
        return $this->db;
    }

    /**
     * @throws Throwable
     */
    public function renderPartial(string $view, array $params = []):string
    {
        $file_path = [dirname(__DIR__)];
        $file_path[] = 'views';
        $file_path[] = $view;
        $file = implode(DIRECTORY_SEPARATOR,$file_path);

        if (!file_exists($file)) {
            throw new Exception('Файл представления не найден.');
        }

        return $this->renderPhpFile($file, $params);
    }

    public function render(string $view, array $params = []):string
    {
        $content = $this->renderPartial( $view, $params);
        return $this->renderWrap($content);
    }

    /**
     * Рендеринг шаблона
     * @param string $content
     * @return string
     * @throws Throwable
     */
    private function renderWrap( string $content): string
    {
        $file_path = [dirname(__DIR__)];
        $file_path[] = 'views';
        $file_path[] = 'layouts';
        $file_path[] = $this->layout;
        $file = implode(DIRECTORY_SEPARATOR,$file_path);

        if (!file_exists($file)) {
            throw new Exception('Файл представления не найден.');
        }

        /**
         * здесь можно переменные вставлять для шаблона
         */
        $params = [
            'content' => $content
        ];

        return $this->renderPhpFile($file, $params);
    }

    private function renderPhpFile(
        string $_file_,
        array $_params_ = []
    ): string {
        $_obInitialLevel_ = ob_get_level();
        ob_start();
        ob_implicit_flush(false);
        extract($_params_, EXTR_OVERWRITE);
        try {
            require $_file_;
            return ob_get_clean();
        } catch (Exception $e) {
            while (ob_get_level() > $_obInitialLevel_) {
                if (!@ob_end_clean()) {
                    ob_clean();
                }
            }
            throw $e;
        } catch (Throwable $e) {
            while (ob_get_level() > $_obInitialLevel_) {
                if (!@ob_end_clean()) {
                    ob_clean();
                }
            }
            throw $e;
        }
    }
}