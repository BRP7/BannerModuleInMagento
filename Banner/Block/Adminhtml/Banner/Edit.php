<?php
class Ccc_Banner_Block_Adminhtml_Banner_Edit extends Mage_Adminhtml_Block_Widget_Form_Container
{
    public function __construct()
    {
        $this->_objectId = 'banner_id';
        $this->_controller = 'adminhtml_banner';
        $this->_blockGroup = 'banner'; // Corrected block group name

        parent::__construct();

        $this->_updateButton('save', 'label', Mage::helper('banner')->__('Save Banner'));
        $this->_updateButton('delete', 'label', Mage::helper('banner')->__('Delete Banner'));

        $this->_addButton('saveandcontinue', array(
            'label'     => Mage::helper('adminhtml')->__('Save and Continue Edit'),
            'onclick'   => 'saveAndContinueEdit()',
            'class'     => 'save',
        ), -100);

        $this->_formScripts[] = "
            function toggleEditor() {
                if (tinyMCE.getInstanceById('block_content') == null) {
                    tinyMCE.execCommand('mceAddControl', false, 'block_content');
                } else {
                    tinyMCE.execCommand('mceRemoveControl', false, 'block_content');
                }
            }

            function saveAndContinueEdit(){
                editForm.submit($('edit_form').action+'back/edit/');
            }
        ";
    }


    protected function _prepareLayout()
    {
        parent::_prepareLayout();

        // Update button labels and remove duplicate button declaration if necessary

        $this->_updateButton('save', 'label', Mage::helper('banner')->__('Save Banner'));
        $this->_updateButton('delete', 'label', Mage::helper('banner')->__('Delete Banner'));

        return $this;
    }

    public function getHeaderText()
    {
        if (Mage::registry('banner_block')->getId()) {
            return Mage::helper('banner')->__('Edit Banner');
        } else {
            return Mage::helper('banner')->__('New Banner');
        }
    }

    public function getFormHtml()
    {
        $form = $this->getChild('form');
        if ($form instanceof Mage_Core_Block_Abstract) {
            return $form->toHtml();
        } else {
            return ''; // Return empty string if form block is not found
        }
    }
    
}
