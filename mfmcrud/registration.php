<?php
use \Magento\Framework\Component\ComponentRegistrar;

ComponentRegistrar::register(
    /* Sets the location of a component.
     * @param string $type component type
     * @param string $componentName Fully-qualified component name
     * @param string $path Absolute file path to the component
     * @throws \LogicException
     * @return void   */
    ComponentRegistrar::MODULE, 'Talexan_MFMCrud', __DIR__);
?>