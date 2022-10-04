<?php
namespace App\Spiders\ItemProcessors;
use RoachPHP\ItemPipeline\ItemInterface;
use RoachPHP\ItemPipeline\Processors\ItemProcessorInterface;
use RoachPHP\Support\Configurable;
use App\Models\Feed;

/**
 * ОБработчик сохранения новости в БД после парсинга и валидации
 */
class SaveFeedProcessor implements ItemProcessorInterface
{
    use Configurable;

    /**
     * Обработчик полученой новости
     * @param ItemInterface $item
     * @return ItemInterface
     */
    public function processItem(ItemInterface $item): ItemInterface
    {
        //Если в БД нет новости с таким url - то добавляем
        if(!Feed::where('url', '=', $item->get('url'))->exists()){
            Feed::create($item->all());
        }
        return $item;
    }
}
