<?php

namespace Iprbooks\Rki\Sdk\collections;

use Iprbooks\Rki\Sdk\Client;
use Iprbooks\Rki\Sdk\Core\Collection;
use Iprbooks\Rki\Sdk\Core\Curl;
use Iprbooks\Rki\Sdk\Models\Book;

class BooksCollection extends Collection
{

    /*
     * Фильтрация по заглавию
     */
    const TITLE = 'title';

    /*
     * Фильтрация по издательству
     */
    const PUBHOUSE = 'pubhouse';

    /*
     * Фильтрация по авторам
     */
    const AUTHOR = 'author';

    /*
     * Ограничение года издания слева
     */
    const YEAR_LEFT = 'year_left';

    /*
     * Ограничение года издания слева
     */
    const YEAR_RIGHT = 'year_right';


    private $apiMethod = '/books/list';


    /**
     * Конструктор BooksCollection
     * @param Client $client
     * @return BooksCollection
     * @throws \Exception
     */
    public function __construct(Client $client)
    {
        parent::__construct($client);
        return $this;
    }

    /**
     * Возвращает метод api
     * @return string
     */
    protected function getApiMethod()
    {
        return $this->apiMethod;
    }

    /**
     * Проверка значений фильтра
     * @param $field
     * @return boolean
     */
    protected function checkFilterFields($field)
    {
        if ($field == self::TITLE || $field == self::PUBHOUSE || $field == self::AUTHOR
            || $field == self::YEAR_LEFT || $field == self::YEAR_RIGHT) {
            return true;
        }
        return false;
    }

    public function get($id = null, $requestType = Curl::POST)
    {
        parent::get($id, $requestType);
    }

    /**
     * Возвращает элемент выборки
     * @param $index
     * @return Book
     * @throws \Exception
     */
    public function getItem($index)
    {
        parent::getItem($index);
        $response = $this->createModelWrapper($this->data[$index]);
        $item = new Book($this->getClient(), $response);
        return $item;
    }
}