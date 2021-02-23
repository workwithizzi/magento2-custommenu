<?php
/**
 * Izzi
 *
 * @category   Izzi
 * @package    Izzi_CustomMenu
 * @license    http://opensource.org/licenses/osl-3.0.php  Open Software License (OSL 3.0)
 */

namespace Izzi\CustomMenu\Api;

interface MenuLinkManagementInterface
{
    /**
     * @param \Magento\Theme\Block\Html\Topmenu $subject
     * @param string $position
     * @return void
     */
    public function addLinks($subject, $position = 'left');

    /**
     * @return string []
     */
    public function getTargetBlanksLinks();
    /**
     *  get open tab
     * @return int
     */
    public function isOpenInTab();
}
