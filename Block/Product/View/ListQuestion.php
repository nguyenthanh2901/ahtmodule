<?php
/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */
namespace AHT\Question\Block\Product\View;

use Magento\Catalog\Api\ProductRepositoryInterface;

/**
 * Product Reviews Page
 *
 * @author     Magento Core Team <core@magentocommerce.com>
 * @SuppressWarnings(PHPMD.CouplingBetweenObjects)
 */
class ListQuestion extends \Magento\Catalog\Block\Product\View
{
    /**
     * Review collection
     *
     * @var ReviewCollection
     */
    protected $_collectionFactory;
    protected $_collection;

    protected $_answerFactory;
    protected $_answerCollection;

    /**
     * @param \Magento\Catalog\Block\Product\Context $context
     * @param \Magento\Framework\Url\EncoderInterface $urlEncoder
     * @param \Magento\Framework\Json\EncoderInterface $jsonEncoder
     * @param \Magento\Framework\Stdlib\StringUtils $string
     * @param \Magento\Catalog\Helper\Product $productHelper
     * @param \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig
     * @param \Magento\Framework\Locale\FormatInterface $localeFormat
     * @param \Magento\Customer\Model\Session $customerSession
     * @param ProductRepositoryInterface $productRepository
     * @param \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency
     * @param \Magento\Review\Model\ResourceModel\Review\CollectionFactory $collectionFactory
     * @param array $data
     * @SuppressWarnings(PHPMD.ExcessiveParameterList)
     */
    public function __construct(
        \Magento\Catalog\Block\Product\Context $context,
        \Magento\Framework\Url\EncoderInterface $urlEncoder,
        \Magento\Framework\Json\EncoderInterface $jsonEncoder,
        \Magento\Framework\Stdlib\StringUtils $string,
        \Magento\Catalog\Helper\Product $productHelper,
        \Magento\Catalog\Model\ProductTypes\ConfigInterface $productTypeConfig,
        \Magento\Framework\Locale\FormatInterface $localeFormat,
        \Magento\Customer\Model\Session $customerSession,
        ProductRepositoryInterface $productRepository,
        \Magento\Framework\Pricing\PriceCurrencyInterface $priceCurrency,
        \AHT\Question\Model\ResourceModel\Question\CollectionFactory $collectionFactory,

        array $data = []
    ) {
        $this->_collectionFactory = $collectionFactory;
        $this->_answerFactory = $collectionFactory;

        parent::__construct(
            $context,
            $urlEncoder,
            $jsonEncoder,
            $string,
            $productHelper,
            $productTypeConfig,
            $localeFormat,
            $customerSession,
            $productRepository,
            $priceCurrency,
            $data
        );
    }
    /**
     * Get collection of reviews
     *
     * @return questionsCollection
     */
    public function getQuestions()
    {
        if (!$this->_collection) {
            $this->_collection = $this->_collectionFactory->create();
            $this->_collection
            ->addFieldToFilter('status', 1)
            ->addFieldToFilter('store_id', $this->_storeManager->getStore()->getId())
            ->addFieldToFilter('product_id', $this->getProduct()->getId());
            $this->_collection
            ->getSelect();
        }
        //  var_dump($this->_collection->getData()); die;
        return $this->_collection;
    }

    public function getAnswers()
    {
        if (!$this->_answerCollection) {
            $this->_answerCollection = $this->_answerFactory->create();
            $this->_answerCollection
            ->addFieldToFilter('status', 1)
            ->addFieldToFilter('store_id', $this->_storeManager->getStore()->getId())
            ->addFieldToFilter('product_id', $this->getProduct()->getId());
            $this->_answerCollection
            ->getSelect()
            ->join(
                ['table1join'=>$this->_collection->getTable('aht_answer')],
                'main_table.question_id = table1join.question_id');
        }
        //  var_dump($this->_answerCollection->getData()); die;

        return $this->_answerCollection;
    }

    
    /**
     * Get product id
     *
     * @return int|null
     */
    public function getProductId()
    {
        $product = $this->_coreRegistry->registry('product');
        return $product ? $product->getId() : null;
    }

    public function getCustomerSession()
    {
        // print_r($this->customerSession->getId());
        return $this->customerSession;
    }

    public function getBaseUrl()
    {
        return $this->_storeManager->getStore()->getBaseUrl();
    }
    
    /**
     * Prepare product review list toolbar
     *
     * @return $this
     */
    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        $toolbar = $this->getLayout()->getBlock('product_question_list.toolbar');
        if ($toolbar) {
            $toolbar->setCollection($this->getQuestions());
            $this->setChild('toolbar', $toolbar);
        }

        return $this;
    }
}
