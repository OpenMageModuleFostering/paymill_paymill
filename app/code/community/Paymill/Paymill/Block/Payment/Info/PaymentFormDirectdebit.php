<?php

/**
 * Magento
 *
 * NOTICE OF LICENSE
 *
 * This source file is subject to the Open Software License (OSL 3.0)
 * that is bundled with this package in the file LICENSE.txt.
 * It is also available through the world-wide-web at this URL:
 * http://opensource.org/licenses/osl-3.0.php
 * If you did not receive a copy of the license and are unable to
 * obtain it through the world-wide-web, please send an email
 * to license@magentocommerce.com so we can send you a copy immediately.
 *
 * @category Paymill
 * @package Paymill_Paymill
 * @copyright Copyright (c) 2013 PAYMILL GmbH (https://paymill.com/en-gb/)
 * @license http://opensource.org/licenses/osl-3.0.php Open Software License (OSL 3.0)
 */
class Paymill_Paymill_Block_Payment_Info_PaymentFormDirectdebit extends Mage_Payment_Block_Info
{

    /**
     * Construct
     */
    protected function _construct()
    {error_log("\r" . "TEST construktor 1" , 3, "/var/tmp/my-errors.log");
        parent::_construct();
        $this->setTemplate('paymill/payment/info/directdebit.phtml');
    }

    /**
     * Render as PDF
     *
     * @return string
     */
    public function toPdf()
    {
        $this->setTemplate('paymill/payment/info/directdebit_pdf.phtml');
        return $this->toHtml();
    }

    /**
     * Add custom information to payment method information
     *
     * @param Varien_Object|array $transport
     */
    protected function _prepareSpecificInformation($transport = null)
    {error_log("\r" . "TEST magento 1" , 3, "/var/tmp/my-errors.log");
        if (null !== $this->_paymentSpecificInformation) {
            return $this->_paymentSpecificInformation;
        }
        $transport = parent::_prepareSpecificInformation($transport);
        $data = array();
        $data['paymillTransactionId'] = $this->getInfo()->getAdditionalInformation('paymillTransactionId');
        $data['paymillPrenotificationDate'] = $this->getInfo()->getAdditionalInformation('paymillPrenotificationDate');
        $data['imgUrl'] = Mage::helper('paymill')->getImagePath() . "icon_paymill.png";

        return $transport->setData(array_merge($data, $transport->getData()));
    }

}
