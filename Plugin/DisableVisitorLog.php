<?php
namespace WeProvide\DisableVisitorLog\Plugin;

use Magento\Framework\App\State;
use Magento\Framework\Event\Observer;

class DisableVisitorLog
{
    protected $developerMode;

    public function __construct(State $state) {
        $this->developerMode = $state->getMode() === $state::MODE_DEVELOPER;
    }

    public function aroundDispatch(
        \Magento\Framework\Event\Invoker\InvokerDefault $subject,
        \Closure $proceed,
        array $configuration,
        Observer $observer
    ) {
        if($configuration['name'] === 'customer_visitor' && $this->developerMode) {
            return false;
        }

        return $proceed($configuration, $observer);
    }
}
