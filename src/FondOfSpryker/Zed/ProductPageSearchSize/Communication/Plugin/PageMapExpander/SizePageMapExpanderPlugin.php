<?php

namespace FondOfSpryker\Zed\ProductPageSearchSize\Communication\Plugin\PageMapExpander;

use FondOfSpryker\Shared\ProductPageSearchSize\ProductPageSearchSizeConstants;
use Generated\Shared\Search\PageIndexMap;
use Generated\Shared\Transfer\LocaleTransfer;
use Generated\Shared\Transfer\PageMapTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductPageSearchExtension\Dependency\PageMapBuilderInterface;
use Spryker\Zed\ProductPageSearchExtension\Dependency\Plugin\ProductAbstractMapExpanderPluginInterface;

class SizePageMapExpanderPlugin extends AbstractPlugin implements ProductAbstractMapExpanderPluginInterface
{
    /**
     * Specification:
     * - Expands and returns the provided PageMapTransfer objects data.
     *
     * @api
     *
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\ProductPageSearchExtension\Dependency\PageMapBuilderInterface $pageMapBuilder
     * @param array $productData
     * @param \Generated\Shared\Transfer\LocaleTransfer $localeTransfer
     *
     * @return \Generated\Shared\Transfer\PageMapTransfer
     */
    public function expandProductMap(PageMapTransfer $pageMapTransfer, PageMapBuilderInterface $pageMapBuilder, array $productData, LocaleTransfer $localeTransfer): PageMapTransfer
    {
        if (!array_key_exists(ProductPageSearchSizeConstants::ATTRIBUTES, $productData)) {
            return $pageMapTransfer;
        }

        if (!array_key_exists(PageIndexMap::SIZE, $productData[ProductPageSearchSizeConstants::ATTRIBUTES])) {
            return $pageMapTransfer;
        }

        if (!method_exists($pageMapTransfer, 'setSize')) {
            return $pageMapTransfer;
        }

        $this->addSizeToPageMapTransfer($pageMapTransfer, $pageMapBuilder, $productData);

        return $pageMapTransfer;
    }

    /**
     * @param \Generated\Shared\Transfer\PageMapTransfer $pageMapTransfer
     * @param \Spryker\Zed\Search\Business\Model\Elasticsearch\DataMapper\PageMapBuilderInterface $pageMapBuilder
     * @param array $productData
     *
     * @return void
     */
    protected function addSizeToPageMapTransfer(PageMapTransfer $pageMapTransfer, PageMapBuilderInterface $pageMapBuilder, array $productData): void
    {
        $size = (ctype_digit($productData[PageIndexMap::SIZE]) === true) ? $productData[PageIndexMap::SIZE] : 0;

        $pageMapBuilder->addIntegerSort($pageMapTransfer, PageIndexMap::SIZE, $size);
        $pageMapBuilder->addIntegerFacet($pageMapTransfer, PageIndexMap::SIZE, $size);

        $pageMapTransfer->setSize($productData[ProductPageSearchSizeConstants::ATTRIBUTES][PageIndexMap::SIZE]);
    }
}
