</div>
</main>

<footer class="footer">
    <div class="container-fluid">
        <div class="row text-muted">
            <div class="col-12 text-start">
                <p class="mb-0">
                    <a class="text-muted" href="<?= $setting["link_author"] ?>" target="_blank">Dian</a>
                    &copy; <?= date("Y") ?>
                </p>
            </div>
        </div>
    </div>
</footer>
</div>
</div>

<script src="../assets/app.js"></script>
<script src="../vendor/simple-datatables/simple-datatables.js"></script>
<script>
    let dataTables = document.querySelectorAll('[id^="data-table"]');
    dataTables.forEach(table => new simpleDatatables.DataTable(table));
</script>

</body>

</html>