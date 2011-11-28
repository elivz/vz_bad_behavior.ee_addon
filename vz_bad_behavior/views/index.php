<?php
    echo form_open('C=addons_extensions'.AMP.'M=save_extension_settings'.AMP.'file=vz_bad_behavior');
    
    $this->table->set_template($cp_pad_table_template);
    
    $this->table->set_heading(
        array('data' => lang('fine_tuning'), 'style' => 'width:50%;'),
        lang('setting')
    );
    $this->table->add_row(
        lang('strict', 'strict') . '<p>'.lang('strict_desc').'</p>',
        '<input type="hidden" name="strict" value="n" />' .
        form_checkbox('strict', 'y', ($settings['strict'] == 'y'), 'id="strict"')
    );
    $this->table->add_row(
        lang('offsite_forms', 'offsite_forms') . '<p>'.lang('offsite_desc').'</p>',
        '<input type="hidden" name="offsite_forms" value="n" />' .
        form_checkbox('offsite_forms', 'y', ($settings['offsite_forms'] == 'y'), 'id="offsite_forms"')
    );
    $this->table->add_row(
        lang('whitelisted_ips', 'whitelisted_ips') . '<p>'.lang('whitelist_desc').'</p>',
        form_textarea('whitelisted_ips', $settings['whitelisted_ips'], 'id="whitelisted_ips"')
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
?>

<?= $this->table->generate() ?>
<?php $this->table->clear() ?>

<?= form_hidden('logging', $settings['logging']) ?>
<?= form_hidden('verbose', $settings['verbose']) ?>
<?= form_hidden('log_table', $settings['log_table']) ?>

<p><?=form_submit('submit', lang('submit'), 'class="submit"')?></p>

<?= form_close() ?>

<!-- Blocked visits report -->

<h2 style="padding:30px 0 10px"><?php printf(lang('num_blocked'), count($blocked)) ?></h2>

<p><a href="#" onclick="$(this).parent().hide();$('#bb_logs').slideDown();return false;"><?= lang('display_logs') ?></a></p>
<div id="bb_logs" style="display:none;">
<?php
    $this->table->set_template($cp_pad_table_template);
    $this->table->set_heading(
        lang('date'),
        lang('ip'),
        lang('uri'),
        lang('method'),
        lang('protocol'),
        lang('user_agent'),
        lang('key')
    );

    foreach ($blocked as $request)
    {
        $this->table->add_row(
            $request['date'],
            $request['ip'],
            array('data'=>$request['request_uri'], 'style'=>'overflow:hidden;max-width:350px', 'title'=>$request['request_uri']),
            $request['request_method'],
            $request['server_protocol'],
            $request['user_agent'],
            '<a href="http://ioerror.us/bb2-support-key?key='.$request['key'].'" target="_blank">'.$request['key'].'</a>'
        );
    }
?>

<?= $this->table->generate() ?>
<?php $this->table->clear() ?>
</div>

<?php
/* End of file index.php */
/* Location: ./system/expressionengine/third_party/vz_bad_behavior/views/index.php */