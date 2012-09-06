<?php
/**
 * This class helps to get import source file names.
 *
 * @package Sp
 * @subpackage Importzento
 * @author subesh
 *
 */
class Sp_Importzento_Model_Source_File
{

 	/**
     * @var Zend_Config_Xml
     */
    protected $_conf;

    public function __construct()
    {
    	$conf = new Zend_Config_Xml(dirname(__FILE__) . '/../../etc/file.xml');
        $this->_conf = $conf;
    }

    /**
     * Destructor
     */
    public function __destruct()
    {
    	unset($this->_conf);
    }

    /**
     * Get File source config
     *
     * @return Zend_Config_Xml
     */
    protected function _getConfig()
    {
    	return $this->_conf;
    }

    /**
     * Get configuration values
     *
     * @param string $type
     * @param string $entity
     * @param string $option
     */
    public function getOptionConfig($type, $entity, $option)
    {
        return $this->_conf->import->$type->$entity->get($option);
    }

    /**
     * Get file name for the entity
     *
     * @param string $type
     * @param string $entity
     */
    public function getFilename($type, $entity)
    {
    	return $this->getOptionConfig($type, $entity, 'file');
    }


}