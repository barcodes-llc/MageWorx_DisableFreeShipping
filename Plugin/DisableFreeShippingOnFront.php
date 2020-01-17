<?php
/**
 * Copyright © 2018 MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace MageWorx\DisableFreeShipping\Plugin;

use Magento\Framework\App\State;

/**
 * Class DisableFreeShippingOnFront
 */
class DisableFreeShippingOnFront
{
    /**
     * @var State
     */
    private $state;

    /**
     * @param State $state
     */
    public function __construct(
        State $state
    ) {
        $this->state = $state;
    }

    /**
     * @param \Magento\OfflineShipping\Model\Carrier\Freeshipping $subject
     * @param callable $proceed
     * @param \Magento\Quote\Model\Quote\Address\RateRequest $request
     * @return \Magento\Shipping\Model\Rate\Result|bool
     * @throws \Magento\Framework\Exception\LocalizedException
     */
    public function aroundCollectRates(
        \Magento\OfflineShipping\Model\Carrier\Freeshipping $subject,
        callable $proceed,
        \Magento\Quote\Model\Quote\Address\RateRequest $request
    ) {
        if ($this->state->getAreaCode() === \Magento\Framework\App\Area::AREA_FRONTEND) {
            return false;
        }

        return $proceed($request);
    }
}