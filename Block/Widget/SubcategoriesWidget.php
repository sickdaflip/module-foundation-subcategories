<?php
namespace Flipdev\Subcategories\Block\Widget;

class SubcategoriesWidget extends \Magento\Framework\View\Element\Template implements \Magento\Widget\Block\BlockInterface
{
    protected $_template = 'widget/subcategories_widget.phtml';

    const DEFAULT_IMAGE_WIDTH = 250;
    const DEFAULT_IMAGE_HEIGHT = 250;

    private $layerResolver;
    public $categoryFactory;

    public function __construct(
    \Magento\Framework\View\Element\Template\Context $context,
    \Magento\Catalog\Model\Layer\Resolver $layerResolver,
    \Magento\Catalog\Model\CategoryFactory $categoryFactory,
    array $data = []
    ) {
        parent::__construct($context, $data);

        $this->layerResolver = $layerResolver;
        $this->categoryFactory = $categoryFactory;
    }

    public function getCategoryCollection()
    {
        $category = $this->categoryFactory->create();

        $rootCatID = NULL;
        if($this->getData('parentcat') > 0)
            $rootCatID = $this->getData('parentcat');
        else
            $rootCatID = $this->_storeManager->getStore()->getRootCategoryId();

        $category->load($rootCatID);
        $childCategories = $category->getChildrenCategories();
        return $childCategories;
    }

    public function getCurrentCategory() {
        return $this->layerResolver->get()->getCurrentCategory();
    }

    public function getCategoryData($id) {
        return $this->categoryFactory->create()->load($id);
    }

    /**
    * Get the width of product image
    * @return int
    */
    public function getImageWidth() {
        if($this->getData('imagewidth')==''){
            return DEFAULT_IMAGE_WIDTH;
        }
        return (int) $this->getData('imagewidth');
    }

    /**
    * Get the height of product image
    * @return int
    */
    public function getImageHeight() {
        if($this->getData('imageheight')==''){
            return DEFAULT_IMAGE_HEIGHT;
        }
        return (int) $this->getData('imageheight');
    }

    public function canShowImage(){
        if($this->getData('image') == 'image')
            return true;
        elseif($this->getData('image') == 'no-image')
            return false;
    }
}