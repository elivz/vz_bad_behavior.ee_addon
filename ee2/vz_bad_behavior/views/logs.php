<table class="mainTable padTable col-sortable" cellpadding="0" cellspacing="0" border="0">
    <thead>
            <th scope="col" class="headerSortUp"><?= lang('date') ?></th>
            <th scope="col"><?= lang('ip') ?></th>
            <th scope="col"><?= lang('uri') ?></th>
            <th scope="col"><?= lang('method') ?></th>
            <th scope="col"><?= lang('protocol') ?></th>
            <th scope="col"><?= lang('user_agent') ?></th>
            <th scope="col"><?= lang('key') ?></th>
    </thead>

    <tbody>
    <?php foreach ($blocked as $i => $request) : ?>
        <tr<?php if ($i % 2 == 0) echo ' class="odd"' ?>>
            <td><?= $request['date'] ?></td>
            <td><?= $request['ip'] ?></td>
            <td style="overflow:hidden;max-width:350px" title"<?= $request['request_uri'] ?>"><?= $request['request_uri'] ?></td>
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