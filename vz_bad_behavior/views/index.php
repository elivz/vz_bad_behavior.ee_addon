<?php
    echo form_open('C=addons_extensions'.AMP.'M=save_extension_settings'.AMP.'file=vz_bad_behavior');

    $this->table->set_template($cp_pad_table_template);
    
    $this->table->set_heading(
        array('data' => lang('fine_tuning'), 'style' => 'width:50%;'),
        lang('setting')
    );
    $this->table->add_row(
        lang('strict', 'strict') . '<p>'.lang('strict_desc').'</p>',
        form_checkbox('strict', 'y', ($settings['strict'] == 'y'), 'id="strict"')
    );
    $this->table->add_row(
        lang('offsite_forms', 'offsite_forms') . '<p>'.lang('offsite_desc').'</p>',
        form_checkbox('offsite_forms', 'y', ($settings['offsite_forms'] == 'y'), 'id="offsite_forms"')
    );
    
    echo $this->table->generate();
    $this->table->clear();
    
    $this->table->set_template($cp_pad_table_template);
    
    $this->table->set_heading(
        array('data' => lang('httpbl'), 'style' => 'width:50%;'),
        lang('setting')
    );
    $this->table->add_row(
        lang('httpbl_key', 'httpbl_key') . '<p>'.lang('httpbl_key_desc').'</p>',
        form_input('httpbl_key', $settings['httpbl_key'], 'id="httpbl_key"')
    );
    $this->table->add_row(
        lang('httpbl_threat', 'httpbl_threat') . '<p>'.lang('httpbl_threat_desc').'</p>',
        form_input('httpbl_threat', $settings['httpbl_threat'], 'id="httpbl_threat"')
    );
    $this->table->add_row(
        lang('httpbl_maxage', 'httpbl_maxage') . '<p>'.lang('httpbl_maxage_desc').'</p>',
        form_input('httpbl_maxage', $settings['httpbl_maxage'], 'id="httpbl_maxage"')
    );
    
    echo $this->table->generate();
    $this->table->clear();
?>

<p><?=form_submit('submit', lang('submit'), 'class="submit"')?></p>
<?php $this->table->clear()?>
<?=form_close()?>

<?php
/* End of file index.php */
/* Location: ./system/expressionengine/third_party/vz_bad_behavior/views/index.php */