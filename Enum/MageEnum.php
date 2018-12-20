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

/**
 * Class MageEnum
 *
 * @package SoftSpark\Checkout\Enum
 */
class MageEnum extends Enum
{
    /** @var int */
    const ENABLED = 1;

    /** @var int */
    const DISABLED = 0;

    /** @var string */
    const SCOPE_WEBSITES = 'websites';

    /** @var string */
    const SCOPE_STORES = 'stores';
}
