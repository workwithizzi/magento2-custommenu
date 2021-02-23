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

class StaticLinks extends AbstractFieldArray
{
    protected function _prepareToRender(): void
    {

        $this->addColumn('link_text', ['label' => __('Text')]);
        $this->addColumn('link_url', ['label' => __('Url')]);
        $this->addColumn('position', ['label' => __('Sort Order')]);
        $this->_addAfter = false;
        $this->_addButtonLabel = __('Add Custom Link');
    }
}
