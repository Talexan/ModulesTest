<?php

namespace Talexan\UsersList\Block\Adminhtml\Edit;

use Magento\Backend\Block\Widget\Context;
use Magento\Framework\Registry;

/**
 * Class GenericButton
 *
 * @package Talexan\UsersList\Block\Adminhtml\Edit
 */
class GenericButton
{
    /**
     * @var Context
     */
    protected $context;
    /**
     * Url Builder
     *
     * @var \Magento\Framework\UrlInterface
     */
    private $urlBuilder;
    /**
     * Registry
     *
     * @var \Magento\Framework\Registry
     */
    private $registry;

    /**
     * GenericButton constructor.
     *
     * @param Context $context
     * @param Registry $registry
     */
    public function __construct(
        Context $context,
        Registry $registry
    ) {
        $this->context = $context;
        $this->urlBuilder = $context->getUrlBuilder();
        $this->registry = $registry;
    }

    /**
     * @return mixed|null
     */
    public function getId()
    {
        $Id = $this->context->getRequest()->getParam('id');
        if (!empty($Id)) {
            return $Id;
        }

        return null;
    }

    /**
     * @param string $route
     * @param array $params
     * @return string
     */
    public function getUrl($route = '', $params = [])
    {
        return $this->urlBuilder->getUrl($route, $params);
    }
}