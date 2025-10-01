<?= $list ?>
<form class="row row-cols-lg-auto g-3 align-items-center ms-1 mb-3 normal" action="receivingstatsu.php?m=a" method="post">
    <input type="hidden" name="sid" value="<?= $_REQUEST["sid"] ?>" />
    <input type="hidden" name="tid" value="<?= $_REQUEST["tid"] ?>" />
    <input type="hidden" name="sea" value="<?= $currentSeason ?>" />
    <input type="hidden" name="cid" value="Receiving" />
    <div class="col-1">
        <img src="<?=$filepath?>_assets/img/logos/<?=$logo?>.png" class="img-sm">
    </div>
    <div class="col-2 w-20">
            <input type="text" class="form-control" name="player" id="player" autocomplete="off" placeholder="Lastname, Firstname">
            <div id="search-result"></div>
    </div>
    <div class="col-2">
        <div class="input-group">
            <input type="text" class="form-control" name="receptions" id="receptions" placeholder="Receptions" style="width:100px;">
        </div>
    </div>
    <div class="col-2">
        <div class="input-group">
            <input type="text" class="form-control" name="yards" id="yards" placeholder="Yards" style="width:100px;">
        </div>
    </div>
    <div class="col-2">
        <div class="input-group">
            <input type="text" class="form-control" name="tds" placeholder="TDs" style="width:100px;">
        </div>
    </div>
    <div class="col-1">
        <button type="submit" class="btn btn-primary">Add</button>
    </div>
</form>