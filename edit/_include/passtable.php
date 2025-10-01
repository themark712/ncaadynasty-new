
<?= $list ?>

<form class="row  g-3 align-items-center ms-1 mb-3 normal" action="passingstatsu.php?m=a" method="post">
    <input type="hidden" name="sid" value="<?= $_REQUEST["sid"] ?>" />
    <input type="hidden" name="tid" value="<?= $_REQUEST["tid"] ?>" />
    <input type="hidden" name="sea" value="<?= $currentSeason ?>" />
    <input type="hidden" name="cid" value="Passing" />

    <div class="col-1 w-5">
        <img src="<?= $filepath ?>_assets/img/logos/<?= $logo ?>.png" class="img-sm">
    </div>
    <div class="col-2 w-20">
        <input type="text" class="form-control" name="player" id="player" autocomplete="off" placeholder="Lastname, Firstname">
        <div id="search-result"></div>
    </div>
    <div class="col-2 w-8">
        <div class="input-group">
            <input type="text" class="form-control" name="completions" id="completions" placeholder="Comp">
        </div>
    </div>
    <div class="col-2 w-8">
        <div class="input-group">
            <input type="text" class="form-control" name="attempts" id="attempts" placeholder="Att">
        </div>
    </div>
    <div class="col-2 w-8">
        <div class="input-group">
            <input type="text" class="form-control" name="yards" id="yards" placeholder="Yards">
        </div>
    </div>
    <div class="col-2 w-8">
        <div class="input-group">
            <input type="text" class="form-control" name="tds" placeholder="TDs">
        </div>
    </div>
    <div class="col-2 w-8">
        <div class="input-group">
            <input type="text" class="form-control" name="int" placeholder="INT">
        </div>
    </div>
    <div class="col-1">
        <button type="submit" class="btn btn-primary">Add</button>
    </div>
</form>