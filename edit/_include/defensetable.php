<?= $list ?>
    
<form class="row row-cols-lg-auto g-3 align-items-center ms-1 mb-3 normal" action="defensestatsu.php?m=a" method="post">
    <input type="hidden" name="sid" value="<?= $_REQUEST["sid"] ?>" />
    <input type="hidden" name="tid" value="<?= $_REQUEST["tid"] ?>" />
    <input type="hidden" name="sea" value="<?= $currentSeason ?>" />
    <input type="hidden" name="cid" value="Defense" />
    <div class="col-1">
        <img src="<?=$filepath?>_assets/img/logos/<?=$logo?>.png" class="img-sm">
    </div>
    <div class="col-2 w-15">
            <input type="text" class="form-control" name="player" id="player" autocomplete="off" placeholder="Lastname, Firstname">
            <div id="search-result"></div>
    </div>
    <div class="col-1 w-5">
        <div class="input-group">
            <input type="text" class="form-control" name="solo" id="solo" placeholder="Solo">
        </div>
    </div>
    <div class="col-1 w-5">
        <div class="input-group">
            <input type="text" class="form-control" name="assist" id="assist" placeholder="Assist">
        </div>
    </div>
    <div class="col-1 w-5">
        <div class="input-group">
            <input type="text" class="form-control" name="tfl" id="tfl" placeholder="TFL">
        </div>
    </div>
    <div class="col-1 w-5">
        <div class="input-group">
            <input type="text" class="form-control" name="sacks" id="sacks" placeholder="Sacks">
        </div>
    </div>
    <div class="col-1 w-5">
        <div class="input-group">
            <input type="text" class="form-control" name="int" id="int" placeholder="INT">
        </div>
    </div>
    <div class="col-1 w-5">
        <div class="input-group">
            <input type="text" class="form-control" name="intyds" id="intyds" placeholder="INTYDS">
        </div>
    </div>
    <div class="col-1 w-5">
        <div class="input-group">
            <input type="text" class="form-control" name="def" id="def" placeholder="Def">
        </div>
    </div>
    <div class="col-1 w-5">
        <div class="input-group">
            <input type="text" class="form-control" name="forcedfumbles" id="forcedfumbles" placeholder="FF">
        </div>
    </div>
    <div class="col-1 w-5">
        <div class="input-group">
            <input type="text" class="form-control" name="fumblerecoveries" id="fumblerecoveries" placeholder="FR">
        </div>
    </div>
    <div class="col-1 w-5">
        <div class="input-group">
            <input type="text" class="form-control" name="fyds" id="fyds" placeholder="FYDS">
        </div>
    </div>
    <div class="col-1 w-5">
        <div class="input-group">
            <input type="text" class="form-control" name="blocks" id="blocks" placeholder="BLKS">
        </div>
    </div>
    <div class="col-1 w-5">
        <div class="input-group">
            <input type="text" class="form-control" name="safety" id="safety" placeholder="SFTY">
        </div>
    </div>
    <div class="col-1 w-5">
        <div class="input-group">
            <input type="text" class="form-control" name="tds" placeholder="TDs">
        </div>
    </div>
    <div class="col-1 w-5">
        <button type="submit" class="btn btn-primary">Add</button>
    </div>
</form>