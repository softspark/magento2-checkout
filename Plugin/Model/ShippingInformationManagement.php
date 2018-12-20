<?php
/**
 * @category   SoftSpark
 * @package    SoftSpark_Checkout
 * @subpackage Plugin
 * @author     Lukasz Krzemień <lukasz.krzemien@softspark.eu>
 * @copyright  Copyright (c) 2018 SoftSpark
 * @since      1.0.0
 */

namespace SoftSpark\Checkout\Plugin\Model;

use Magento\Checkout\Api\Data\ShippingInformationInterface;
use Magento\Checkout\Model\ShippingInformationManagement as MageShippingInformationManagement;

use Magento\Quote\Api\Data\AddressExtensionInterface;
use Magento\Quote\Model\Quote;
use Magento\Quote\Model\QuoteRepository;

use Magento\Framework\Exception\NoSuchEntityException;

/**
 * Class ShippingInformationManagement
 *
 * @package SoftSpark\Checkout\Plugin\Model
 */
class ShippingInformationManagement
{
    /** @var QuoteRepository */
    protected $quoteRepository;

    /**
     * ShippingInformationManagement constructor.
     *
     * @param QuoteRepository $quoteRepository
     */
    public function __construct(
        QuoteRepository $quoteRepository
    ) {
        $this->quoteRepository = $quoteRepository;
    }

    /**
     * @param MageShippingInformationManagement $subject
     * @param int                               $cartId
     * @param ShippingInformationInterface      $addressInformation
     *
     * @throws NoSuchEntityException
     */
    public function beforeSaveAddressInformation(
        MageShippingInformationManagement $subject,
        int $cartId,
        ShippingInformationInterface $addressInformation
    ) {
        /** @var AddressExtensionInterface $extensionAttributes */
        $extensionAttributes = $addressInformation->getShippingAddress()->getExtensionAttributes();
        $externalOrderId     = ($extensionAttributes) ? $extensionAttributes->getExternalOrderId() : '';

        /** @var Quote $quote */
        $quote = $this->quoteRepository->getActive($cartId);
        $quote->setExternalOrderId($externalOrderId);
    }
}
