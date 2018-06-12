<?php
    echo form_open('C=addons_extensions'.AMP.'M=save_extension_settings'.AMP.'file=vz_bad_behavior');

    $this->table->set_template($cp_pad_table_template);

    $this->table->set_heading(
        array('data' => lang('fine_tuning'), 'style' => 'width:50%;'),
        lang('setting')
    );
    $this->table->add_row(
        lang('enabled', 'enabled'),
        '<input type="hidden" name="enabled" value="n" />' .
        form_checkbox('enabled', 'y', ($settings['enabled'] == 'y'), 'id="enabled"')
    );
    $this->table->add_row(
        lang('logging', 'logging') . '<p>'.lang('logging_desc').'</p>',
        '<input type="hidden" name="logging" value="n" />' .
        form_checkbox('logging', 'y', ($settings['logging'] == 'y'), 'id="logging"')
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
        lang('whitelisted_ips', 'whitelisted_ips') . '<p>'.lang('whitelist_ips_desc').'</p>',
        form_textarea(array('name'=>'whitelisted_ips', 'value'=>$settings['whitelisted_ips'], 'id'=>'whitelisted_ips', 'rows'=>'5'))
    );
    $this->table->add_row(
        lang('whitelisted_urls', 'whitelisted_urls') . '<p>'.lang('whitelist_urls_desc').'</p>',
        form_textarea(array('name'=>'whitelisted_urls', 'value'=>$settings['whitelisted_urls'], 'id'=>'whitelisted_urls', 'rows'=>'5'))
    );

    echo $this->table->generate();
    $this->table->clear();


    $this->table->set_template($cp_pad_table_template);

    $this->table->set_heading(
        array('data' => lang('rev_proxy'), 'style' => 'width:50%;'),
        lang('setting')
    );
    $this->table->add_row(
        lang('enable_rev_proxy', 'enable_rev_proxy') . '<p>'.lang('rev_proxy_desc').'</p>',
        '<input type="hidden" name="reverse_proxy" value="n" />' .
        form_checkbox('reverse_proxy', 'y', ($settings['reverse_proxy'] == 'y'), 'id="reverse_proxy"')
    );
    $this->table->add_row(
        array(
            'data' => lang('rev_proxy_header', 'reverse_proxy_header') . '<p>'.lang('rev_proxy_header_desc').'</p>',
            'class' => 'rev_proxy_options'
        ),
        array(
            'data' => form_input('reverse_proxy_header', $settings['reverse_proxy_header'], 'id="reverse_proxy_header" class="rev_proxy_options"'),
            'class' => 'rev_proxy_options',
        )
    );
    $this->table->add_row(
        array(
            'data' => lang('rev_proxy_ips', 'reverse_proxy_addresses') . '<p>'.lang('rev_proxy_ips_desc').'</p>',
            'class' => 'rev_proxy_options'
        ),
        array(
            'data' => form_textarea(array('name'=>'reverse_proxy_addresses', 'value'=>$settings['reverse_proxy_addresses'], 'id'=>'reverse_proxy_addresses', 'rows'=>'4')),
            'class' => 'rev_proxy_options'
        )
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

<?= form_hidden('verbose', $settings['verbose']) ?>
<?= form_hidden('log_table', $settings['log_table']) ?>

<p><?= form_submit('submit', lang('submit'), 'class="submit"') ?></p>

<?= form_close() ?>

<script type="text/javascript">
    function toggle_proxy_options() {
        $('.rev_proxy_options').toggle($('#reverse_proxy').is(':checked'));
    };
    $('#reverse_proxy').change(toggle_proxy_options);
    toggle_proxy_options();
</script>

<?php if ($settings['logging'] == 'y') : ?>
    <!-- Blocked visits report -->

    <h2 style="padding:30px 0 10px"><?php printf(lang('num_blocked'), $blocked_count) ?></h2>

    <p><a href="#" id="show_bb_logs"><?= lang('display_logs') ?></a></p>
    <div id="bb_logs" style="display:none"></div>
    <script type="text/javascript">
        $('#show_bb_logs').click(function() {
            $(this).parent().hide();
            $('#bb_logs').load(
                '<?= $base_url ?>?bb_logs=1',
                function() {
                    $("table.col-sortable").tablesorter();
                    $('#bb_logs').slideDown();
                }
            );
            return false;
        })
    </script>
<?php endif; ?>

<?php
/* End of file index.php */
/* Location: ./system/expressionengine/third_party/vz_bad_behavior/views/index.php */