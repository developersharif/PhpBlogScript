<?php require("include/header.php"); ?>
<link rel="stylesheet" href="plugins/summernote/summernote-bs4.css">
<div class="container">
    <div class="row">
        <div class="col-md-12">
            <?php
            if (isset($_POST["submit"]) & !empty($_POST['content']) and isset($_GET['page'])) {
                $update =  file_put_contents("../" . $_GET["page"] . ".php", $_POST["content"]);
                echo "Update";
            }


            ?>
            <form action="" method="post" class="form-control">
                <b>Select a Page.</b>
                <select name="page" id="page">
                    <?php if (isset($_GET['page'])) { ?> <option><?php echo $_GET['page']; ?></option><?php } else {
                                                                                                        ?><option>
                    </option> <?php  } ?>
                    <option value="about">About page</option>
                    <option value="terms">Terms page</option>
                    <option value="privacy">Privacy policy page</option>
                </select>
                <?php if (isset($_GET["page"])) : ?>
                <textarea class="textarea" name="content" required><?php if (isset($_GET['page'])) {
                                                                            $page = $_GET['page'];
                                                                            echo file_get_contents("../" . $page . ".php");
                                                                        }  ?></textarea><?php endif; ?>
                <?php if (isset($_GET["page"])) : ?><input type="submit" value="Save" name="submit" id="submit"
                    class="btn btn-info"><?php endif; ?>
            </form>
        </div>
    </div>
</div>
<?php require("include/footer.php"); ?>
<script src="plugins/summernote/summernote-bs4.min.js"></script>
<script>
$(function() {
    $('.textarea').summernote({
        height: 300,
        minHeight: null,
        maxHeight: null,
        focus: true
    })
});
$(function() {
    $("#page").change(function() {
        var page = $("#page").val();
        window.location = "?page=" + page; // redirect

    });
})
</script>