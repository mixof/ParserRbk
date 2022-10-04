<?php

namespace App\Spiders\ItemProcessors;
use RoachPHP\ItemPipeline\ItemInterface;
use RoachPHP\ItemPipeline\Processors\ItemProcessorInterface;
use RoachPHP\Support\Configurable;

/**
 * Валидатор данных полученых при парсинге
 */
class ValidateFeedProcessor implements ItemProcessorInterface
{
    use Configurable;

    /**
     * @param ItemInterface $item
     * @return ItemInterface
     */
    public function processItem(ItemInterface $item): ItemInterface
    {
        //Если получено пустое значение то не обрабатываем новость
        if( empty($item->get("title"))||
            empty($item->get("description")) ||
            empty($item->get("url")  )
        ) return $item->drop( sprintf('Some data was not parsed..'));

        return $item;
    }

}
