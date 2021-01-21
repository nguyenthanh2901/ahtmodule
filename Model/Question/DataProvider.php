<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\Question\Model\Question;

use AHT\Question\Model\QuestionFactory;
use AHT\Question\Model\ResourceModel\Question\CollectionFactory;
use Magento\Framework\App\Request\DataPersistorInterface;
use Magento\Store\Model\StoreManagerInterface;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{
    /**
     * @var \Magento\Cms\Model\ResourceModel\Block\Collection
     */
    protected $collection;

    protected $questionFactory;

    protected $productRepository;
    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    protected $_storeManager;

    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        CollectionFactory $blockCollectionFactory,
        DataPersistorInterface $dataPersistor,
        QuestionFactory $questionFactory,
        \Magento\Catalog\Model\ProductRepository $productRepository,
        StoreManagerInterface $storeManager,
        array $meta = [],
        array $data = []
    ) {
        $this->collection = $blockCollectionFactory->create();
        $this->questionFactory = $questionFactory;
        $this->productRepository = $productRepository;
        $this->dataPersistor = $dataPersistor;
        $this->_storeManager =  $storeManager;
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    public function getData()
    {
        if (isset($this->loadedData)) {
            return $this->loadedData;
        }
        $this->collection->getSelect()
        ->join(
            ['table1join'=>$this->collection->getTable('aht_answer')],
            'main_table.question_id = table1join.question_id');
        var_dump($this->collection->getData());die; 
            
        $items = $this->collection->getItems();

        foreach ($items as $block) {
            $this->loadedData[$block->getId()] = $block->getData();
        }
        // echo '<pre>';
        //     print_r($this->loadedData);
        // echo '</pre>'; die;
        return $this->loadedData;
    }
}
