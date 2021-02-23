<?php
/**
 * Izzi
 *
 * @category   Izzi
 * @package    Izzi_CustomMenu
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Izzi\CustomMenu\Block\Adminhtml\Form\Field;

use Magento\Config\Block\System\Config\Form\Field\FieldArray\AbstractFieldArray;

class CmsPageCustomLinker extends AbstractFieldArray
{
    const FIELDS_EXTRA_CLASS_PREFIX = 'izzi-cpcl-';

    const FIELD_TEMPLATE = 'Izzi_CustomMenu::system/config/form/field/array.phtml';

    private $linkTypesRenderer;

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

    protected function _prepareToRender()
    {
        $this->addColumn(
            'link_type',
            ['label' => __('Link Type'), 'renderer' => $this->getLinkTypesRenderer()]
        );
        $this->addColumn(
            'page_id',
            ['label' => __('Cms Pages'), 'renderer' => $this->getCmsPagesRenderer()]
        );
        $this->addColumn('link_text', ['label' => __('Text'),'class' =>$this->getFieldExtraClassName('link_text')]);
        $this->addColumn('link_url', ['label' => __('Url'),'class' => $this->getLinkUrlExtraHtmlClass()]);
        $this->addColumn('position', ['label' => __('Sort Order')]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add Link');
    }

    private function getCmsPagesRenderer()
    {
        if (!$this->cmsPagesRenderer) {
            $this->cmsPagesRenderer = $this->getLayout()->createBlock(
                \Izzi\CustomMenu\Block\Adminhtml\Form\Field\Pages::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
            $this->cmsPagesRenderer->setClass('customer_group_select ' . $this->getPageIdExtraHtmlClass());
        }
        return $this->cmsPagesRenderer;
    }

    private function getLinkTypesRenderer()
    {
        if (!$this->linkTypesRenderer) {
            $this->linkTypesRenderer = $this->getLayout()->createBlock(
                \Izzi\CustomMenu\Block\Adminhtml\Form\Field\LinkTypes::class,
                '',
                ['data' => ['is_render_to_js_template' => true]]
            );
            $this->linkTypesRenderer->setClass('customer_group_select ' . $this->getLinkTypeExtraHtmlClass());
        }
        return $this->linkTypesRenderer;
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

        $optionExtraAttr['option_' . $this->linkTypesRenderer->calcOptionHash($row->getData('link_type'))] =
            'selected="selected"';
        $optionExtraAttr['option_' . $this->getCmsPagesRenderer()->calcOptionHash($row->getData('page_id'))] =
            'selected="selected"';

        $row->setData(
            'option_extra_attrs',
            $optionExtraAttr
        );
    }

    public function getTemplate()
    {
        return self::FIELD_TEMPLATE;
    }

    public function getInputFieldHtmlId()
    {
        return $this->getHtmlId();
    }

    private function getFieldExtraClassName($fieldName)
    {
        return self::FIELDS_EXTRA_CLASS_PREFIX . $fieldName;
    }

    public function getLinkTypeExtraHtmlClass()
    {
        return $this->getFieldExtraClassName('link_type');
    }
    public function getPageIdExtraHtmlClass()
    {
        return $this->getFieldExtraClassName('page_id');
    }

    public function getLinkUrlExtraHtmlClass()
    {
        return $this->getFieldExtraClassName('link_url');
    }
}
