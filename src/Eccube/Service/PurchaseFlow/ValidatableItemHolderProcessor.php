<?php

namespace Eccube\Service\PurchaseFlow;

use Eccube\Entity\ItemHolderInterface;

abstract class ValidatableItemHolderProcessor implements ItemHolderProcessor
{
    use ValidatorTrait;

    /**
     * @param ItemHolderInterface $itemHolder
     * @param PurchaseContext     $context
     *
     * @return ProcessResult
     */
    final public function process(ItemHolderInterface $itemHolder, PurchaseContext $context)
    {
        try {
            $this->validate($itemHolder, $context);

            return ProcessResult::success();
        } catch (InvalidItemException $e) {
            return ProcessResult::error($e->getMessage());
        }
    }

    abstract protected function validate(ItemHolderInterface $itemHolder, PurchaseContext $context);

    protected function handle(ItemHolderInterface $itemHolder)
    {
    }
}