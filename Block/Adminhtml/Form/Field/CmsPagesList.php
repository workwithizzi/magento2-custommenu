<?php
/**
 * Izzi
 *
 * @category   Izzi
 * @package    Izzi_CustomMenu
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Izzi\CustomMenu\Block\Adminhtml\Form\Field;

class CmsPagesList extends \Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray
{

    private $cmsPagesRenderer;
    /**
     * @var \Izzi\CustomMenu\Model\Config\Source\Pages
     */
    private $cmsPages;

    public function __construct(
        \Magento\Backend\Block\Template\Context $context,
        \Izzi\CustomMenu\Model\Config\Source\Pages $cmsPages,
        array $data = []
    ) {
        parent::__construct($context, $data);
        $this->cmsPages = $cmsPages;
    }

    private function getCmsPagesRenderer()
    {
        if (!$this->cmsPagesRenderer) {
            $this->cmsPagesRenderer = $this->getLayout()->createBlock(
                \Izzi\CustomMenu\Block\Adminhtml\Form\Field\Pages::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
            $this->cmsPagesRenderer->setClass('customer_group_select');
        }
        return $this->cmsPagesRenderer ;
    }

    protected function _prepareToRender(): void
    {
        $this->addColumn(
            'page_id',
            ['label' => __('Cms Pages'), 'renderer' => $this->getCmsPagesRenderer()]
        );
        $this->addColumn('position', ['label' => __('Sort Order')]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add Cms Pages');
    }
    /**
     * Prepare existing row data object
     *
     * @param \Magento\Framework\DataObject $row
     * @return void
     */
    protected function _prepareArrayRow(\Magento\Framework\DataObject $row)
    {
        $optionExtraAttr = [];
        $optionExtraAttr['option_' . $this->getCmsPagesRenderer()->calcOptionHash($row->getData('page_id'))] =
            'selected="selected"';
        $row->setData(
            'option_extra_attrs',
            $optionExtraAttr
        );
    }
}
