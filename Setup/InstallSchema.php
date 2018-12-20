<?php
/**
 * @category   SoftSpark
 * @package    SoftSpark_Checkout
 * @subpackage Setup
 * @author     Lukasz Krzemień <lukasz.krzemien@softspark.eu>
 * @copyright  Copyright (c) 2018 SoftSpark
 * @since      1.0.0
 */

namespace SoftSpark\Checkout\Setup;

use Magento\Framework\App\Config\ConfigResource\ConfigInterface;
use Magento\Framework\Setup\SchemaSetupInterface;
use Magento\Framework\Setup\ModuleContextInterface;
use Magento\Framework\Setup\InstallSchemaInterface;
use Magento\Store\Model\StoreManagerInterface;

use SoftSpark\Checkout\Enum\ConfigPathEnum;
use SoftSpark\Checkout\Enum\MageEnum;
use SoftSpark\Checkout\Enum\SetupEnum;

/**
 * Class InstallSchema
 *
 * @package SoftSpark\Checkout\Setup
 */
class InstallSchema implements InstallSchemaInterface
{
    /** @var ConfigInterface */
    protected $config;

    /** @var StoreManagerInterface */
    protected $storeManager;

    /**
     * InstallSchema constructor.
     *
     * @param ConfigInterface       $config
     * @param StoreManagerInterface $storeManager
     */
    public function __construct(
        ConfigInterface $config,
        StoreManagerInterface $storeManager
    ) {
        $this->config       = $config;
        $this->storeManager = $storeManager;
    }

    /**
     * @return void
     */
    protected function setConfig(): void
    {
        $this->config->saveConfig(
            ConfigPathEnum::CONFIG_CHECKOUT_OPTIONS_GUEST_CHECKOUT,
            MageEnum::DISABLED
        );

        foreach ($this->storeManager->getWebsites() as $website) {
            $this->config->saveConfig(
                ConfigPathEnum::CONFIG_CHECKOUT_OPTIONS_GUEST_CHECKOUT,
                MageEnum::DISABLED,
                MageEnum::SCOPE_WEBSITES,
                $website->getId()
            );
        }

        foreach ($this->storeManager->getStores() as $store) {
            $this->config->saveConfig(
                ConfigPathEnum::CONFIG_CHECKOUT_OPTIONS_GUEST_CHECKOUT,
                MageEnum::DISABLED,
                MageEnum::SCOPE_STORES,
                $store->getId()
            );
        }
    }

    /**
     * @param SchemaSetupInterface   $setup
     * @param ModuleContextInterface $context
     *
     * @return void
     */
    public function install(SchemaSetupInterface $setup, ModuleContextInterface $context)
    {
        $this->setConfig();

        $setup->startSetup();

        $this->addExternalOrderId($setup);

        $setup->endSetup();
    }

    /**
     * @param SchemaSetupInterface $setup
     *
     * @return void
     */
    protected function addExternalOrderId(SchemaSetupInterface $setup): void
    {
        $connection = $setup->getConnection();

        if (!$connection->tableColumnExists(SetupEnum::TABLE_SALES_ORDER, SetupEnum::COLUMN_EXTERNAL_ORDER_ID)) {
            $connection->addColumn(
                $setup->getTable(SetupEnum::TABLE_SALES_ORDER),
                SetupEnum::COLUMN_EXTERNAL_ORDER_ID,
                SetupEnum::COLUMN_EXTERNAL_ORDER_ID_OPTIONS
            );
        }

        if (!$connection->tableColumnExists(SetupEnum::TABLE_SALES_ORDER_GRID, SetupEnum::COLUMN_EXTERNAL_ORDER_ID)) {
            $connection->addColumn(
                $setup->getTable(SetupEnum::TABLE_SALES_ORDER_GRID),
                SetupEnum::COLUMN_EXTERNAL_ORDER_ID,
                SetupEnum::COLUMN_EXTERNAL_ORDER_ID_OPTIONS
            );
        }

        if (!$connection->tableColumnExists(SetupEnum::TABLE_QUOTE, SetupEnum::COLUMN_EXTERNAL_ORDER_ID)) {
            $connection->addColumn(
                $setup->getTable(SetupEnum::TABLE_QUOTE),
                SetupEnum::COLUMN_EXTERNAL_ORDER_ID,
                SetupEnum::COLUMN_EXTERNAL_ORDER_ID_OPTIONS
            );
        }
    }
}
