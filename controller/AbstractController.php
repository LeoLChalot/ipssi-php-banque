<?php
abstract class AbstractController
{
    public function render(string $view, array $params = []): void
    {
        extract($params);
        ob_start();
        require('vue/pages/' . $view . '.php');
        $content = ob_get_clean();
        require('vue/template.php');
    }
}
