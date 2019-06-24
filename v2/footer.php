    <hr>
    <footer>
        <div class="row text-center">
            <div class="col-lg-12">
                <p>Copyright &copy; Berk Cetinsaya <?php echo date("Y"); ?></p>
            </div>
        </div>
    </footer>
    </div>
    <script src="assets/js/jquery.js"></script>
    <script src="assets/js/bootstrap.min.js"></script>
    <?php
    if ($page_title == "SayChat") { ?>
        <script>
            $('.carousel').carousel({
                interval: 5000
            });
        </script>
    <?php } else if ($page_title == "Sign Up") { ?>

        <script src="assets/js/jquery.js"></script>

        <script src="assets/js/bootstrap.min.js"></script>

        <script src="assets/js/jqBootstrapValidation.js"></script>
        <script>
            function isNumber(evt) {
                evt = (evt) ? evt : window.event;
                var charCode = (evt.which) ? evt.which : evt.keyCode;
                if (charCode > 31 && (charCode < 48 || charCode > 57)) {
                    return false;
                }
                return true;
            }
        </script>
    <?php } if($page_title == "Profile"){?>
    <script>
        var clipboard = new Clipboard('#cpy');
        clipboard.on('success', function(e) {
            console.log(e);
        });
        clipboard.on('error', function(e) {
            console.log(e);
        });
    </script>
    <?php } ?>
    </body>

    </html>