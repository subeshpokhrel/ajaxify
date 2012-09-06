<?php
class Sp_Ajaxify_Helper_Data extends Mage_Core_Helper_Abstract
{

	public function getMessageUrl()
	{
		return Mage::getUrl('ajaxify/index/message');
	}
}