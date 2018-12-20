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
use Magento\Framework\DB\Ddl\Table;

/**
 * Class SetupEnum
 *
 * @package SoftSpark\Checkout\Enum
 */
class SetupEnum extends Enum
{
    /** @var string */
    const TABLE_SALES_ORDER = 'sales_order';

    /** @var string */
    const TABLE_SALES_ORDER_GRID = 'sales_order_grid';

    /** @var string */
    const TABLE_QUOTE = 'quote';

    /** @var string */
    const TYPE = 'type';

    /** @var string */
    const NULLABLE = 'nullable';

    /** @var string */
    const LENGTH = 'length';

    /** @var string */
    const COMMENT = 'comment';

    /** @var string */
    const COLUMN_EXTERNAL_ORDER_ID = 'external_order_id';

    /** @var string */
    const COLUMN_EXTERNAL_ORDER_ID_OPTIONS = [
        self::TYPE     => Table::TYPE_TEXT,
        self::NULLABLE => true,
        self::LENGTH   => 40,
        self::COMMENT  => 'External Order Id'
    ];
}
