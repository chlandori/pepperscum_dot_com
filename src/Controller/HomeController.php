<?php
namespace Chlandori\PepperscumDotCom\Controller;

use Chlandori\PepperscumDotCom\Service\HitCounter;

class HomeController
{
    private $hitCounter;

    public function __construct(HitCounter $hitCounter)
    {
        $this->hitCounter = $hitCounter;
    }

    public function index(): void
    {
        session_start();

        if (empty($_SESSION['hit_home'])) {
            $this->hitCounter->recordHit('home');
            $_SESSION['hit_home'] = true;
        }

        $hitCounter = $this->hitCounter;
        $pageName   = 'home';
        $view       = __DIR__ . '/../../app/views/home/index.php';

        include __DIR__ . '/../../app/views/layout.php';
    }
}
