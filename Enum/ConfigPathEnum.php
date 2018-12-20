<?php
/**
 * @category   SoftSpark
 * @package    SoftSpark_Checkout
 * @subpackage Enum
 * @author     Lukasz Krzemień <lukasz.krzemien@softspark.eu>
 * @copyright  Copyright (c) 2018 SoftSpark
 * @since      1.0.0
 */

namespace SoftSpark\Checkout\Enum;

use MabeEnum\Enum;

class ConfigPathEnum extends Enum
{
    /** @var string */
    const CONFIG_CHECKOUT_OPTIONS_GUEST_CHECKOUT = 'checkout/options/guest_checkout';
}

