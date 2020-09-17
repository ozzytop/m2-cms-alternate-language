<?php
namespace Ozzytop\Cms\Block;

use Magento\Store\Model\ScopeInterface;
use Magento\Config\Model\Config\Backend\Admin\Custom;

class Cms extends \Magento\Framework\View\Element\Template
{

    protected $_page;
    protected $_pageRepositoryInterface;
    protected $_store;
    protected $_scopeConfig;
    
    /**
     * Undocumented function
     *
     * @param \Magento\Framework\View\Element\Template\Context $context
     * @param \Magento\Cms\Model\Page $page
     * @param \Magento\Cms\Api\PageRepositoryInterface $pageRepositoryInterface
     * @param \Magento\Store\Api\StoreRepositoryInterface $store
     * @param \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
     */
    public function __construct(
        \Magento\Framework\View\Element\Template\Context $context,
        \Magento\Cms\Model\Page $page,
        \Magento\Cms\Api\PageRepositoryInterface $pageRepositoryInterface,
        \Magento\Store\Api\StoreRepositoryInterface $store,
        \Magento\Framework\App\Config\ScopeConfigInterface $scopeConfig
    ) {
        parent::__construct($context);
        $this->_page = $page;
        $this->_pageRepositoryInterface = $pageRepositoryInterface;
        $this->_store = $store;
        $this->_scopeConfig = $scopeConfig;
    }

    /**
     * Get Page's identifier
     *
     * @return string
     */
    private function _getPageIdentifier()
    {
        return $this->_page->getIdentifier();
    }
    

    /**
     * Get Current Page's id
     *
     * @return int
     */
    public function getPageId()
    {
        return $this->_page->getId();
    }


    /**
     * Get Store information
     * 
     * Get array with store information: base_url and language of the view's store
     *
     * @param int|string $id Page's id
     * @return array
     */
    public function getPages($id)
    {
            $pages = $this->_pageRepositoryInterface->getById($id)->getData();
            $store = array();

            foreach($pages['store_id'] as $storeId){ 
                // If the store id is equal to 0 (means default store) won't add a new link.
                if($storeId == '0'){
                    continue;
                }
                
                $store[] = array(
                    'url' =>  $this->_scopeConfig->getValue(Custom::XML_PATH_SECURE_BASE_URL, ScopeInterface::SCOPE_STORE, $storeId) . $this->_getPageIdentifier(),
                    'language' => $this->_scopeConfig->getValue(Custom::XML_PATH_GENERAL_LOCALE_CODE, ScopeInterface::SCOPE_STORE, $storeId)
                );
            } 
            return $store;
    }    
}