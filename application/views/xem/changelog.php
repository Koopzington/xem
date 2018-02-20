<ul class="breadcrumb">
    <?php if($element->isDraft()):?>
        <li><?=anchor('xem/draft/'.$element->parent, $element->main_name)?> <span class="divider">/</span></li>
    <?php else:?>
        <li><?=anchor('xem/show/'.$element->id, $element->main_name)?> <span class="divider">/</span></li>
    <?php endif?>
    <li class="active">Changelog</li>
</ul>

<?php if($events):?>
<table id="changelog">
    <!--
    <tr>
        <th>Time</th>
        <th>User</th>
        <th>Description</th>
    </tr>
    -->
    <?php foreach($events as $curEvent):?>
    <tr>
        <td style="padding-right:20px;white-space:nowrap;" title="id: <?=$curEvent['id']?>"><?=$curEvent['time']?></td>
        <td style="text-align:right;padding-right:4px;"><?=$curEvent['user_nick']?></td>
        <td><?=$curEvent['human_form']?></td>
    </tr>
    <?php endforeach?>
</table>
<?php else:?>
    <h2>No data found</h2>
<?php endif;?>

<script type="text/javascript">
$('tr:has(.draft_bottom)').addClass('draft_bottom');
$('tr:has(.draft_top)').addClass('draft_top');
$('tr:has(.suppressed)').hide();
</script>
