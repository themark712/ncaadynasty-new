<?php
$hero_title = "Edit Article";
$hero_text = "Edit article";
include '../_include/header.php';

if ($_SERVER['REQUEST_METHOD'] == "POST") {
    $arra["id"] = $_REQUEST["a"];
    $arra["week"] = $_POST["week"];
    $arra["title"] = $_POST["title"];
    $arra["content"] = $_POST["content"];
    $arra["week"] = $_POST["week"];
    $arra["created"] = $_POST["date"];

    $sql = "UPDATE dynarticles SET week=:week, title=:title, content=:content, created=:created WHERE id=:id";
    $result = query($sql, $arra);
}

$query = "SELECT * FROM dynarticles WHERE id=" . $_REQUEST["a"];
$result = query($query);

$title = "";
$content = "";
$week = "";

if ($result) {
    foreach ($result as $row) {
        $title =  $row["title"];
        $content =  $row["content"];
        $week =  $row["week"];
        $date =  $row["created"];
    }
}
?>

<!-- About Section -->
<section id="article" class="about section">

    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6 d-flex align-items-stretch">
                <h2>Edit Article</h2>
            </div>
        </div>
        <form name="article" action="article.php?a=<?= $_REQUEST["a"] ?>" method="post">
            <div class="row g-3 align-items-center">
                <div class="col-1">
                    Week </div>
                <div class="col-1">
                    <div class="input-group">
                        <select class="form-select" name="week">
                            <option value='0'>- # -</option>
                            <?php
                            for ($i = 0; $i <= 18; $i++) {
                            ?>
                                <option value="<?php echo $i; ?>" <?php if ($week == $i) { ?> selected <?php } ?>><?php echo $i; ?></option>
                            <?php } ?>
                        </select>
                    </div>
                </div>
                <div class="col-6">
                    <div class="input-group"><input class="form-control" type="text" name="title" placeholder="title" value="<?= $title ?>" /></div>
                </div>
                <div class="col-3">
                    <div class="input-group"><input class="form-control" type="text" name="date" placeholder="date" value="<?= $date ?>" /></div>
                </div>
                <div class="col-12">
                    <div class="input-group"><textarea name="content" class="form-control" id="summernote" rows="200" placeholder="content"><?= $content ?></textarea>
                    </div>
                </div>
            </div>
            <div class="row row-cols-md-auto g-3 align-items-center">
                <div class="col-12">
                    <div class="input-group"><input type="submit" value="Update" class="btn btn-primary"></div>
                    <a href="articles.php">Back to Article List</a>
                </div>
            </div>
        </form>

    </div>
</section>

<?php include '../_include/footer.php'; ?>