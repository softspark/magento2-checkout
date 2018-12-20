<?php
/**
 * @category   SoftSpark
 * @package    SoftSpark_Checkout
 * @subpackage Observer
 * @author     Lukasz Krzemień <lukasz.krzemien@softspark.eu>
 * @copyright  Copyright (c) 2018 SoftSpark
 * @since      1.0.0
 */

namespace SoftSpark\Checkout\Observer;

use Magento\Framework\Event\Observer;
use Magento\Framework\Event\ObserverInterface;
use Magento\Framework\Exception\NoSuchEntityException;
use Magento\Quote\Api\CartRepositoryInterface;
use Magento\Quote\Model\Quote;
use Magento\Sales\Model\Order;

/**
 * Class SalesEventQuoteToOrderObserver
 *
 * @package SoftSpark\Checkout\Observer
 */
class SalesEventQuoteToOrderObserver implements ObserverInterface
{
    /** @var CartRepositoryInterface */
    protected $cartRepository;

    /**
     * SalesEventQuoteToOrderObserver constructor.
     *
     * @param CartRepositoryInterface $cartRepository
     */
    public function __construct(
        CartRepositoryInterface $cartRepository
    ) {
        $this->cartRepository = $cartRepository;
    }

    /**
     * @param Observer $observer
     *
     * @return $this
     * @throws NoSuchEntityException
     */
    public function execute(Observer $observer)
    {
        $order = $observer->getEvent()->getOrder();

        if ($order->getReordered()) {
            return $this;
        }

        /** @var Order $order */
        $order = $observer->getOrder();

        /** @var Quote $quote */
        $quote = $this->cartRepository->get($order->getQuoteId());

        $order->setExternalOrderId($quote->getExternalOrderId());

        return $this;
    }
}
