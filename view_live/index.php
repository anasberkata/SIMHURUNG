<?php
include "../templates/header.php";

$live = query("SELECT * FROM live WHERE id_live = 1")[0];

if (isset($_POST["ubah_link"])) {
    if (live_ubah($_POST) > 0) {
        echo "<script>
                alert('Link berhasil di ubah');
                document.location.href = 'index.php';
            </script>";
    } else {
        echo "<script>
                alert('Link gagal di ubah');
                document.location.href = 'index.php';
            </script>";
    }
}

// var_dump($live);
?>



<h1 class="h3 mb-3">Live Monitoring</h1>

<div class="row">
    <div class="col-xl-6 col-xxl-5 d-flex">
        <div class="card flex-fill w-100">
            <div class="card-header">
                <h5 class="card-title mb-0">Input URL</h5>
            </div>
            <div class="card-body py-3">
                <form action="" method="POST">
                    <label>Link</label>
                    <input type="text" class="form-control my-2" name="link" value="<?= $live["link"] ?>">
                    <button type="submit" name="ubah_link" class="btn btn-primary w-100">Simpan</button>
                    <a href="<?= $live["link"] ?>" class="btn btn-dark w-100 mt-3" target="_blank">Live Streaming</a>
                </form>
            </div>

        </div>
    </div>

    <!-- <div class="col-xl-6 col-xxl-7">
        <div class="card flex-fill w-100">
            <div class="card-header">
                <h5 class="card-title mb-0">Live Monitoring</h5>
            </div>
            <div class="card-body py-3">

                <img id="videoStream" src="<?= $live["link"] ?>" alt="Stream not available" width="640" height="480">
                <script>
                    const videoElement = document.getElementById('videoStream');
                    setInterval(() => {
                        videoElement.src = `<?= $live["link"] ?>?${Date.now()}`;
                    }, 1000);
                </script>


            </div>
        </div>
    </div> -->
</div>



<?php
include "../templates/footer.php";
?>