<?php
/**
 * Izzi
 *
 * @category   Izzi
 * @package    Izzi_CustomMenu
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Izzi\CustomMenu\Block\Adminhtml\System\Config\Form\Fieldset;

use Magento\Framework\Data\Form\Element\Renderer\RendererInterface;

class Support extends \Magento\Backend\Block\Template implements RendererInterface
{
    /**
     * @var string
     */
    protected $_template = 'Izzi_CustomMenu::system/config/form/fieldset/support.phtml';

    /**
     * @var \Magento\Framework\App\ProductMetadataInterface
     */
    protected $metaData;

    /**
     * @var \Magento\Framework\Module\ModuleList\Loader
     */
    protected $loader;

    /**
     * @param \Magento\Backend\Block\Template\Context $context
     * @param \Magento\Framework\App\ProductMetadataInterface $productMetaData
     * @param \Magento\Framework\Module\ModuleList\Loader $loader
     * @param array $data
     */
    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Magento\Framework\App\ProductMetadataInterface $productMetaData,
        \Magento\Framework\Module\ModuleList\Loader $loader,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->metaData = $productMetaData;
        $this->loader = $loader;
    }

    /**
     * @param \Magento\Framework\Data\Form\Element\AbstractElement $element
     * @return mixed
     */
    public function render(\Magento\Framework\Data\Form\Element\AbstractElement $element)
    {
        return $this->toHtml();
    }

    public function getMageVersion()
    {
        $mageVersion = $this->metaData->getVersion();
        $mageEdition = $this->metaData->getEdition();
        switch ($mageEdition) {
            case 'Community':
                $mageEdition = 'CE';
                break;
            case 'Enterprise':
                $mageEdition = 'EE';
                break;
        }

        return $mageEdition . ' ' . $mageVersion;
    }

    public function getModuleVersion()
    {
        $modules = $this->loader->load();
        $v = "";
        if (isset($modules['Izzi_CustomMenu'])) {
            $v = $modules['Izzi_CustomMenu']['setup_version'];
        }
        return $v;
    }
}
