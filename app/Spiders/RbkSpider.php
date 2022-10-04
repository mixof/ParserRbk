<?php

namespace App\Spiders;

use App\Spiders\ItemProcessors\ValidateFeedProcessor;
use Generator;
use RoachPHP\Http\Response;
use RoachPHP\Spider\BasicSpider;
use App\Spiders\ItemProcessors\SaveFeedProcessor;
use RoachPHP\Spider\Middleware\MaximumCrawlDepthMiddleware;

/**
 * Класс парсера новостей с rbc.ru
 */
class RbkSpider extends BasicSpider {

    /**
     * @var array|string[] Url запрашиваемый при начале парсинга
     */
    public array $startUrls = [
        'https://rbc.ru/'
    ];

    /**
     * @var int Задержка между запросами
     */
    public int $requestDelay = 2;

    /**
     * Ограничение по количеству запросов
     */
    public array $spiderMiddleware = [
        [
            MaximumCrawlDepthMiddleware::class,
            ["maxCrawlDepth" => 15]
        ]
    ];

    /**
     * Обработчики распарсеных данных
     */
    public array $itemProcessors = [
        ValidateFeedProcessor::class,
        SaveFeedProcessor::class,

    ];

    /**
     * Обработчик основного url
     * @param Response $response
     * @return Generator
     */
    public function parse(Response $response): Generator {
        //Собираем линки на новости
        $links = $response->filter("a.news-feed__item")->links();
        foreach ($links as $link) {
            //Делаем запрос на каждую страницу с подробным описанием
            yield $this->request("GET",
                $link->getUri(),
                'parseDetailsPage'
            );

        }
    }

    /**
     * Поиск заголовка новости в DOM
     * @param Response $response
     * @return string|null
     */
    protected function findTitle(Response $response) {
        $selectors = [
            ".article__title",
            "h1",
        ];

        foreach ($selectors as $selector) {
            if ($response->filter($selector)->count() > 0) {
                return $response->filter($selector)->text();
            }
        }
        return null;
    }


    /**
     * Поиск описания новости в DOM
     * @param Response $response
     * @return string|null
     */
    protected function findDescription(Response $response) {
        $selectors = [
            "article p",
            ".article p"
        ];

        foreach ($selectors as $selector) {
            if ($response->filter($selector)->count() > 0) {
                $desc_items = $response->filter($selector)->each(function ($item) {
                    return $item->text() . "</br>";
                });

                if (!empty($desc_items)) {
                    return implode("", $desc_items);
                }
            }
        }

        return null;
    }

    /**
     * Поиск url новости
     * @param Response $response
     * @return string|null
     */
    protected function findUrl(Response $response) {
        return $response->getUri();
    }

    /**
     * Поиск главного изображения в DOM
     * @param Response $response
     * @return string|null
     */
    protected function findImage(Response $response) {
        $selectors = [
            ".article__header-img img",
            ".article__main-image__wrap img"
        ];

        foreach ($selectors as $selector) {
            $img = $response->filter($selector);
            if ($img->count() > 0) {
                $img_url = $img->last()->attr("src");
                if (!empty($img_url)) {
                    //Если указан относительный путь то оборачиваем url
                    if (!str_contains($img_url, "http")) {
                        $urlInfo = parse_url($response->getUri());
                        $base = $urlInfo["scheme"] . "://" . $urlInfo["host"];
                        $img_url = $base . str_replace("./", "/", $img_url);
                    }
                    return $img_url;
                }
            }
        }
        return null;
    }

    /** Собираем всю информацию полученную со страницы
     * @param Response $response
     * @return Generator
     */
    public function parseDetailsPage(Response $response): Generator {
        yield $this->item([
            'title' => $this->findTitle($response),
            'description' => $this->findDescription($response),
            'image_url' => $this->findImage($response),
            'url' => $this->findUrl($response),
        ]);

    }
}
