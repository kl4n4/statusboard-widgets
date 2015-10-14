<style>
    tr td {
        font-size: 1.3em;
    }
    .name {
        width: 200px;
    }

    .branch {
        width: 150px;
        text-align: center;
    }

    .revision {
        width: 120px;
    }

    .date {
        width: auto;
        text-align: center;
    }
</style>

<table>
    <tr>
        <th class="name">Application</th>
        <th class="branch">Branch</th>
        <!--<th class="revision">Revision ID</th>-->
        <th class="date">Date</th>
    </tr>
<?php foreach($data as $deployment): ?>
    <tr>
        <td class="name"><?=$this->e($deployment['name'])?></td>
        <td class=branch><?=$this->e($deployment['branch'])?></td>
        <!--<td class="revision"><?=$this->e($this->substr($deployment['revision'],0,10))?></td>-->
        <td class=date><?=$this->e($deployment['date'])?></td>
    </tr>
<?php endforeach ?>
</table>
