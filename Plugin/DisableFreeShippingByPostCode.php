<?php
/**
 * Copyright © 2020 MageWorx. All rights reserved.
 * See LICENSE.txt for license details.
 */

namespace MageWorx\DisableFreeShipping\Plugin;

/**
 * Class DisableFreeShippingByPostCode
 */
class DisableFreeShippingByPostCode
{
    /**
     * @param \Magento\OfflineShipping\Model\Carrier\Freeshipping $subject
     * @param callable $proceed
     * @param \Magento\Quote\Model\Quote\Address\RateRequest $request
     * @return \Magento\Shipping\Model\Rate\Result|bool
     */
    public function aroundCollectRates(
        \Magento\OfflineShipping\Model\Carrier\Freeshipping $subject,
        callable $proceed,
        \Magento\Quote\Model\Quote\Address\RateRequest $request
    ) {
        if ($request->getDestPostcode()) { // Check is postcode exists in request
            return $proceed($request);
        }

        return false;
    }
}
