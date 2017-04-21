<?php

namespace Augustash\FixSalesRule\Model\Rule\Condition;

/**
 * Implements the workaround proposed in magento/magento2#8407
 * @see https://github.com/magento/magento2/issues/8407
 */
class FixProduct extends \Magento\SalesRule\Model\Rule\Condition\Product
{
    /**
     * Validate Product Rule Condition
     *
     * @param \Magento\Framework\Model\AbstractModel $model
     * @return bool
     */
    public function validate(\Magento\Framework\Model\AbstractModel $model)
    {
        //@todo reimplement this method when is fixed MAGETWO-5713
        /** @var \Magento\Catalog\Model\Product $product */

        /**
         * Workaround
         * @see https://github.com/magento/magento2/issues/8407
         */
        if (($options = $model->getQtyOptions()) && !empty($options)) {
            // Resolve selected variant from configurable product
            $product = reset($options)->getProduct();
        } else {
            $product = $model->getProduct();
            if (!$product instanceof \Magento\Catalog\Model\Product) {
                $product = $this->productRepository->getById($model->getProductId());
            }
        }

        $product->setQuoteItemQty(
            $model->getQty()
        )->setQuoteItemPrice(
            $model->getPrice() // possible bug: need to use $model->getBasePrice()
        )->setQuoteItemRowTotal(
            $model->getBaseRowTotal()
        );

        return \Magento\Rule\Model\Condition\Product\AbstractProduct::validate($product);
    }
}
