<?php

namespace V4U\DefaultPaymentMethod\Helper;
use Magento\Framework\App\Helper\AbstractHelper;
use Magento\Store\Model\ScopeInterface;

/**
 * Class Data
 * @package V4U\DefaultPaymentMethod\Helper
 */
class Data extends AbstractHelper
{
    const CONFIG_DEFAULT_PAYMENT = 'defaultpaymentmethod/payment/default_method';

    /**
     * @param $field
     * @param null $storeId
     * @return mixed
     */
    public function getConfigValue($field, $storeId = null)
    {
        return $this->scopeConfig->getValue(
            $field, ScopeInterface::SCOPE_STORE, $storeId
        );
    }

    /**
     * @param null $storeId
     * @return mixed
     */
    public function getDefaultPaymentMethod($storeId = null)
    {
        return $this->getConfigValue(self::CONFIG_DEFAULT_PAYMENT, $storeId);
    }
}
