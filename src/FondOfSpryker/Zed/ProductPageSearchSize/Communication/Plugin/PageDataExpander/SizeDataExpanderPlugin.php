<?php

namespace FondOfSpryker\Zed\ProductPageSearchSize\Communication\Plugin\PageDataExpander;

use FondOfSpryker\Shared\ProductPageSearchSize\ProductPageSearchSizeConstants;
use Generated\Shared\Search\PageIndexMap;
use Generated\Shared\Transfer\ProductPageSearchTransfer;
use Spryker\Zed\Kernel\Communication\AbstractPlugin;
use Spryker\Zed\ProductPageSearch\Dependency\Plugin\ProductPageDataExpanderInterface;

class SizeDataExpanderPlugin extends AbstractPlugin implements ProductPageDataExpanderInterface
{
    public const PLUGIN_NAME = 'SizeDataExpanderPlugin';

    /**
     * @param array $productData
     * @param \Generated\Shared\Transfer\ProductPageSearchTransfer $productAbstractPageSearchTransfer
     *
     * @return void
     */
    public function expandProductPageData(array $productData, ProductPageSearchTransfer $productAbstractPageSearchTransfer): void
    {
        if (!array_key_exists(ProductPageSearchSizeConstants::ATTRIBUTES, $productData)) {
            return;
        }

        $productAttributesData = json_decode($productData[ProductPageSearchSizeConstants::ATTRIBUTES], true);

        if (!array_key_exists(PageIndexMap::SIZE, $productAttributesData)) {
            return;
        }

        if (!method_exists($productAbstractPageSearchTransfer, 'setSize')) {
            return;
        }

        $productAbstractPageSearchTransfer->setSize($productAttributesData[PageIndexMap::SIZE]);
    }
}
