<?php

namespace Systemfy\App\Controller;

class Error404Controller implements Controller
{
    public function processaRequisicao(): void
    {
        http_response_code(404);
        echo "<h1>404 Not Found</h1>";
        echo "<p>A página que você está procurando não foi encontrada.</p>";
    }
}