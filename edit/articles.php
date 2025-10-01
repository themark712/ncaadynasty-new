<?php
$hero_title = "Articles";
$hero_text = "Edit articles";

include '../_include/header.php';

$aryb[0][0] = "/mydynasties.php";
$aryb[0][1] = "My Dynasties";
$aryb[1][0] = "/edit/dynasty.php?id=" . $_SESSION["dyn"];
$aryb[1][1] = "Dynasty Home";
$aryb[2][0] = "/edit/articles.php";
$aryb[2][1] = "Articles";

$query = "SELECT * FROM dynarticles WHERE seasonid=" . $currentSeason;
$result = query($query);

$articles = "<table class='table table-sm'";
if ($result) {
    foreach ($result as $row) {
        $articles .="<tr>";
        $articles .="<td>" . $row["week"] . "</td>";
        $articles .="<td>" . $row["created"] . "</td>";
        $articles .="<td><a href='article.php?a=" . $row["id"] . "'>" . $row["title"] . "</a></td>";
        $articles .="<td><a href='articlesu.php?m=d&a=" . $row["id"] . "' class='text-danger'><i class='bi bi-trash'></i></a></td>";
        $articles .="</tr>";
    }
}
$articles .= "</table>";
?>

<!-- About Section -->
<section id="article" class="about section">

    <div class="container-fluid">
        <div class="row">
            <?=$articles?>
        </div>
        <div class="row mb-2">
            <div class="col-sm-6 d-flex align-items-stretch">
                <h5>New Article</h5>
            </div>
        </div>
        <form  name="newarticle" action="articlesu.php" method="post">
            <div class="row align-items-center">
                <div class="col-2">
                    <div class="input-group">Week 
                        <select class="form-select" name="week">
                            <option value='0'>- # -</option>
                            <?php
                            foreach (WEEKS as $i) {
                            ?>
                                <option value="<?php echo $i; ?>"><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-4 mb-2">
                    <div class="input-group"><input class="form-control" type="text" name="title" placeholder="title" /></div>
                </div>
                <div class="col-3 mb-2">
                    <div class="input-group"><input class="form-control" type="text" name="date" placeholder="yyyy-mm-dd 24:mm:ss" /></div>
                </div>
                <div class="col-12">
                    <div class="input-group"><textarea name="content" class="form-control" id="summernote" rows="100" placeholder="content" value="<?= old_value('content') ?>" maxlength="500"></textarea>
                    </div>
                </div>
            </div>
            <div class="row row-cols-md-auto g-3 align-items-center">
                <div class="col-12">
                    <div class="input-group"><input type="submit" value="Add" class="btn btn-primary"></div>
                </div>
            </div>
        </form>

    </div>

</section>


<?php include '../_include/footer.php'; ?>