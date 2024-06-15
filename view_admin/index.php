<?php
include "../templates/header.php";

$live = query("SELECT * FROM live WHERE id_live = 1")[0];

?>


<h1 class="h3 mb-3">Dashboard</h1>

<div class="row">
    <div class="col-12 col-md-6 d-flex">
        <div class="card flex-fill">
            <div class="card-header">
                <h5 class="card-title mb-0">Live</h5>
            </div>
            <div class="card-body">
                <h5>URL : <?= $live["link"] ?></h5>
                <br>
                <img id="videoStream" src="<?= $live["link"] ?>" alt="Stream not available" width="640" height="480">
                <script>
                    const videoElement = document.getElementById('videoStream');
                    setInterval(() => {
                        videoElement.src = `<?= $live["link"] ?>?${Date.now()}`;
                    }, 1000);
                </script>
            </div>
        </div>
    </div>
</div>



<?php
include "../templates/footer.php";
?>