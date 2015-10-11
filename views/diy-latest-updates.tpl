<?php $this->layout('diy-layout', ['attributes' => $attributes]) ?>
<style>
    .update td {
        color: white;
        font-size: 20px;
        text-transform: none;
    }
    .update .image {
        width: 160px;
        height: 120px;
    }
    .update .image img {
        width: 160px;
        height: 110px;
        max-height: none;
        border: 1px solid grey;
    }
    .update .content {
        padding: 0 !important;
    }
    .update .content h2 {
        font-weight: bold;
    }
    .update .content ul {
        padding: 3px 0;
    }
    .update .content li {
        font-size: 80%;
        margin-left: 0.8em;
    }
    .update .content li:before {
        content: "• ";
        color: #c06;
    }
    .update .terms {
        float: left;
        font-size: 65%;
        margin-left: 0.8em;
        text-decoration: underline;
    }
    .update .terms .term {
    }
    .update .date {
        float: right;
        color: grey;
        font-size: 65%;
        padding-right: 20px;
        text-align: right;
    }
</style>
<table id="container">
<?php foreach($data as $update): ?>
    <tr class="update">
        <td class="image">
            <img src="https://images.updatemi.com/crop/180/120/<?=$this->e($update['image']['focus_point_x'])?>/<?=$this->e($update['image']['focus_point_y'])?>/<?=base64_encode($this->e($update['image']['url']))?>" />
        </td>
        <td class="content">
            <h2><?=$this->e($update['headline'])?></h2>
            <ul>
                <?php foreach(array_slice($update['summary'],0,3) as $line): ?>
                    <li><?=$this->e($this->cleanWikiSyntax($line))?></li>
                <?php endforeach ?>
            </ul>
            <p class="terms">
                <span class="term main"><?=$this->e($update['main_term']['name'])?></span>
                <?php foreach($update['additional_terms'] as $term): ?>
                    &nbsp; | &nbsp; <span class="term main"><?=$this->e($term['name'])?></span>
                <?php endforeach ?>
            </p>
            <p class="date"><?=$this->e((new \DateTime($update['release_date']))->format('H:i'))?></p>
        </td>
    </tr>
<?php endforeach ?>
</table>
