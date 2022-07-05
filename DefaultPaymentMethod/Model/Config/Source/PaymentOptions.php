<?php

namespace V4U\DefaultPaymentMethod\Model\Config\Source;
use \Magento\Framework\Data\OptionSourceInterface;
use \Magento\Payment\Api\PaymentMethodListInterface;
use \Magento\Framework\App\RequestInterface;

/**
 * Class PaymentOptions
 * @package V4U\DefaultPaymentMethod\Model\Config\Source
 */
class PaymentOptions implements OptionSourceInterface
{
    /**
     * @var PaymentMethodListInterface
     */
    protected $paymentMethodList;

    /**
     * @var RequestInterface
     */
    protected $request;

    public function __construct(
        PaymentMethodListInterface $paymentMethodList,
        RequestInterface $request

    )
    {
        $this->paymentMethodList = $paymentMethodList;
        $this->request = $request;
    }

    /**
     * @return \Magento\Payment\Api\Data\PaymentMethodInterface[]
     */
    public function getAvailablePaymentMethods() {
        $storeId = (int) $this->request->getParam('store');
        return $this->paymentMethodList->getActiveList($storeId);
    }

    /**
     * Return array of options as value-label pairs
     *
     * @return array
     */
    public function toOptionArray()
    {
        $options = array();
        $paymentMethods = $this->getAvailablePaymentMethods();

        $options[] = array(
            'label' => '',
            'value' => ''
        );

        foreach($paymentMethods as $paymentMethod)
        {
            $options[] = array(
                'label' => $paymentMethod->getTitle(),
                'value' => $paymentMethod->getCode()
            );
        }

        return $options;
    }
}