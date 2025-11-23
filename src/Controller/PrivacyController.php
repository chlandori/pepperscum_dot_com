<?php
namespace Chlandori\PepperscumDotCom\Controller;

use Chlandori\PepperscumDotCom\Service\HitCounter;

class PrivacyController
{
    private $hitCounter;

    public function __construct(HitCounter $hitCounter)
    {
        $this->hitCounter = $hitCounter;
    }

    public function index(): void
    {
        session_start();

        if (empty($_SESSION['hit_privacy'])) {
            $this->hitCounter->recordHit('privacy');
            $_SESSION['hit_privacy'] = true;
        }

        $hitCounter = $this->hitCounter;
        $pageName   = 'privacy';
        $view       = __DIR__ . '/../../app/views/privacy/index.php';

        include __DIR__ . '/../../app/views/layout.php';
    }
}
