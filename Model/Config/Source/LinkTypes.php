<?php
/**
 * Izzi
 *
 * @category   Izzi
 * @package    Izzi_CustomMenu
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Izzi\CustomMenu\Model\Config\Source;

class LinkTypes implements \Magento\Framework\Option\ArrayInterface
{

	private $options;

	public function toOptionArray(): array
	{
		if (!$this->options) {
			$this->options[] = ['value' => 1,'label'=> __('Cms Page')];
			$this->options[] = ['value' => 2,'label'=> __('Internal Custom Link')];
			$this->options[] = ['value' => 3,'label'=> __('External Custom Link')];
		}
		return $this->options;
	}

	public function getOptions()
	{
		$result = [];
		$options = $this->toOptionArray();

		foreach ($options as $option) {
			$result[$option['value']] = $option['label'];
		}
		return $result;
	}
}
