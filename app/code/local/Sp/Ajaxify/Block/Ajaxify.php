<?php
class Sp_Ajaxify_Block_Ajaxify extends Mage_Core_Block_Template
{
	
	protected function _toHtml()
	{
		$html = '<script type="text/javascript">' .
					'var SP_AJAXIFY_MESSAGE_URL = "' . Mage::helper('ajaxify')->getMessageUrl() . '";' . 
				'</script>';
		
		$html .= '<script type="text/javascript" src=" ' . Mage::getBaseUrl('js') . 'ajaxify/ajaxify.js"/>';
		return $html;
	}
	
}