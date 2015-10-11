<?php $this->layout('diy-layout', ['attributes' => $attributes]) ?>
<style>
    .update {
        clear: both;
        height: 120px;
    }
    .update img {
        float: left;
    }
    .update .content {
        float: left;
    }
    .update .content h2 {
        font-weight: bold;
    }
    .update .content li {
        font-size: 80%;
    }
</style>
<ul id="container">
<?php foreach($data as $update): ?>
    <li class="update">
        <img src="https://images.updatemi.com/crop/180/120/<?=$this->e($update['image']['focus_point_x'])?>/<?=$this->e($update['image']['focus_point_y'])?>/<?=base64_encode($this->e($update['image']['url']))?>" />
        <div class="content">
            <h2><?=$this->e($update['headline'])?></h2>
            <ul>
                <?php foreach($update['summary'] as $line): ?>
                    <li><?=$this->e($line)?></li>
                <?php endforeach ?>
            </ul>
        </div>
    </li>
<?php endforeach ?>
</ul>
