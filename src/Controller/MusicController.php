<?php
namespace Chlandori\PepperscumDotCom\Controller;

use Chlandori\PepperscumDotCom\Service\HitCounter;

class MusicController
{
    private $hitCounter;

    public function __construct(HitCounter $hitCounter)
    {
        $this->hitCounter = $hitCounter;
    }

    public function index(): void
    {
        session_start();

        if (empty($_SESSION['hit_music'])) {
            $this->hitCounter->recordHit('music');
            $_SESSION['hit_music'] = true;
        }

        $hitCounter = $this->hitCounter;
        $pageName   = 'music';
        $view       = __DIR__ . '/../../app/views/music/index.php';

        include __DIR__ . '/../../app/views/layout.php';
    }
}
