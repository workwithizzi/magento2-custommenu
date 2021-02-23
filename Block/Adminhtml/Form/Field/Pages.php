<?php
/**
 * Izzi
 *
 * @category   Izzi
 * @package    Izzi_CustomMenu
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */


namespace Izzi\CustomMenu\Block\Adminhtml\Form\Field;

class Pages extends \Magento\Framework\View\Element\Html\Select
{

    /**
     * @var \Izzi\CustomMenu\Model\Config\Source\Pages
     */
    private $cmsPages;

    public function __construct(
        \Izzi\CustomMenu\Model\Config\Source\Pages $cmsPages,
        \Magento\Framework\View\Element\Context $context,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->cmsPages = $cmsPages;
    }
    public function _toHtml()
    {
        // @codingStandardsIgnoreStart
        if (!$this->getOptions()) {
            foreach ($this->cmsPages->getOptions() as $pageIndetifier => $PageTitle) {
                $this->addOption($pageIndetifier, addslashes($PageTitle));
            }
        }
        // @codingStandardsIgnoreEnd
        return parent::_toHtml();
    }
    /**
     * @param string $value
     * @return $this
     */
    public function setInputName($value)
    {
        return $this->setName($value);
    }
}
