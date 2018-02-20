<div>
    <?php if($curShows):?>
    <?php if(isset($forceAdd)):?>
        <h2>We already have shows that contain that name</h2>
    <?php else:?>
        <h3><?php echo count($shows); ?> Shows Found</h3>
    <?php endif;?>
        <table style="width: auto; margin-bottom: 0;">
            <thead>
                <tr>
                    <th>show name</th>
                    <th class="input-small">created</th>
                    <th>last modified</th>
                </tr>
            </thead>
            <tbody>
            <?php foreach($curShows as $show):?>
                <tr>
                    <td>
                        <?=anchor('xem/show/'.$show->id,$show->main_name)?>
                        <?php if(isset($show->name)):?>
                            (<?=$show->name?>)
                        <?php endif?>
                    </td>
                    <td>
                        <span title="<?=$show->created?> UTC"><?php $data = explode(' ', $show->created); echo $data[0] ?></span>
                    </td>
                    <td>
                        <?php echo $show->last_modified == "0000-00-00 00:00:00" ? '' : $show->last_modified .' UTC'?>
                    </td>
                </tr>
            <?php endforeach?>
            </tbody>
        </table>
    <?php else:?>
        <h2>No Shows Found</h2>
    <?php endif;?>

    <?php if(isset($forceAdd)):?>
    <br>
    <div class="well" style="margin-bottom: 0;">
        <h2>Add Show</h2>
        <?=form_open("xem/addShow", array('class' => 'form-horizontal'))?>
            <input id="newElementName" name="main_name" class="input-large">
            <label class="checkbox" for="forceAdd"><input type="checkbox" name="forceAdd" id="forceAdd"> I know what I am doing</label>
            <input type="submit" value="Add" class="btn btn-danger">
        </form>
    </div>
    <?php endif;?>
</div>

<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.tablesorter/2.28.15/js/jquery.tablesorter.combined.min.js"></script>
<script>
    $(function() {
        $.tablesorter.filter.types.start = function( config, data ) {
            if ( /^\^/.test( data.iFilter ) ) {
                return data.iExact.indexOf( data.iFilter.substring(1) ) === 0;
            }
            return null;
        };
        $.tablesorter.filter.types.end = function( config, data ) {
            if ( /\$$/.test( data.iFilter ) ) {
                var filter = data.iFilter,
                    filterLength = filter.length - 1,
                    removedSymbol = filter.substring(0, filterLength),
                    exactLength = data.iExact.length;
                return data.iExact.lastIndexOf(removedSymbol) + filterLength === exactLength;
            }
            return null;
        };
        $("table").tablesorter({
            theme : "bootstrap",
            headerTemplate : '{content} {icon}',
            sortLocaleCompare : true,
            emptyTo: 'bottom',
            widgets : [ "uitheme", "filter", "zebra" ],
            widgetOptions : {
                zebra : ["even", "odd"],
                filter_hideEmpty : true,
                filter_hideFilters : false
            }
        });
    });
</script>