<table class="mainTable padTable" cellpadding="0" cellspacing="0" border="0">
    <thead>
            <th><?= lang('date') ?></th>
            <th><?= lang('ip') ?></th>
            <th><?= lang('uri') ?></th>
            <th><?= lang('method') ?></th>
            <th><?= lang('protocol') ?></th>
            <th><?= lang('user_agent') ?></th>
            <th><?= lang('key') ?></th>
    </thead>
    
    <tbody>
    <?php foreach ($blocked as $request) : ?>
        <tr>
            <td><?= $request['date'] ?></td>
            <td><?= $request['ip'] ?></td>
            <td><?= array('data'=>$request['request_uri'], 'style'=>'overflow:hidden;max-width:350px', 'title'=>$request['request_uri']) ?></td>
            <td><?= $request['request_method'] ?></td>
            <td><?= $request['server_protocol'] ?></td>
            <td><?= $request['user_agent'] ?></td>
            <td><?= '<a href="http://ioerror.us/bb2-support-key?key='.$request['key'].'" target="_blank">'.$request['key'].'</a>' ?></td>
        </tr>
    <?php endforeach; ?>
    </tbody>
</table>

<?php
/* End of file index.php */
/* Location: ./system/expressionengine/third_party/vz_bad_behavior/views/logs.php */