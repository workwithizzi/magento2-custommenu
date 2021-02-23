<?php
/**
 * Izzi
 *
 * @category   Izzi
 * @package    Izzi_CustomMenu
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Izzi\CustomMenu\Plugin\Magento\Theme\Block\Html;

use Magento\Store\Model\ScopeInterface;

class RightTopmenu
{

    const XMLPATH_CONFIG_IS_ENABLED = 'custommenu/cms_custom_links/enable';

    /**
     * @var \Izzi\CustomMenu\Api\MenuLinkManagementInterface
     */
    private $menuLinkManagement;

    /**
     * @var \Psr\Log\LoggerInterface
     */
    private $logger;

    /**
     * @var \Magento\Framework\App\Config\ScopeConfigInterface
     */
    private $scopeConfig;

    public function __construct(
        \Magento\Framework\App\Config\ScopeConfigInterface  $scopeConfig,
        \Izzi\CustomMenu\Api\MenuLinkManagementInterface $menuLinkManagement,
        \Psr\Log\LoggerInterface $logger
    ) {

        $this->logger = $logger;
        $this->scopeConfig = $scopeConfig;
        $this->menuLinkManagement = $menuLinkManagement;
    }

    public function beforeGetHtml(
        \Magento\Theme\Block\Html\Topmenu $subject,
        $limit = 0,
        $childrenWrapClass = '',
        $outermostClass = ''
    ) {

        if ($this->isEnabled()) {
            $this->menuLinkManagement->addLinks($subject, 'right');
            return [$limit, $childrenWrapClass, $outermostClass];
        }
    }

    private function isEnabled()
    {
        return $this->scopeConfig->getValue(
            self::XMLPATH_CONFIG_IS_ENABLED,
            ScopeInterface::SCOPE_STORE
        );
    }
    public function afterToHtml(
        \Magento\Theme\Block\Html\Topmenu $subject,
        $html
    ) {
        $jsBlockOutPut =$subject->getLayout()
            ->createBlock(
                \Izzi\CustomMenu\Block\Html\Topmenu\Js::class,
                'cms.link.to.menu.js'
            )
            ->setTemplate('Izzi_CustomMenu::html/topmenu/js.phtml')
            ->toHtml();
        return $html.$jsBlockOutPut;
    }
}
