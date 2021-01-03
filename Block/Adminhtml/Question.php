<?php
namespace AHT\Question\Block\Adminhtml;
class Question extends \Magento\Backend\Block\Widget\Grid\Container
{
    protected function _construct()
    {
        $this->_blockGroup = 'AHT_Question';
        $this->_controller = 'adminhtml_question';
        parent::_construct();
    }
}