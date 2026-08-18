<!-- ===== MAIN JS ===== -->
<script src="https://code.jquery.com/jquery-3.6.4.min.js" integrity="sha256-oP6HI9z1XaZNBrJURtCoUT5SUnxFr8s3BzRl+cbzUq8=" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@10"></script>
    <script src="<?php echo assets('assets/js/login.js') ?>"></script>
    <?php
        ade_yield('scripts');

        if (isset($_GET['error'])) {
        //check if error is not empty
        if (!empty($_GET['error'])) {
    ?>
            <script>
                $(document).ready(function() {
                    Swal.fire({
                        icon: 'error',
                        title: 'Oops...',
                        text: '<?php echo $_GET['error']; ?>',
                    }).then((result) => {
                        //remove error from url
                        history.pushState(null, null, window.location.href.split("?")[0]);
                    });
                });
            </script>
    <?php
        }
    }
    ?>
    </body>
</html>