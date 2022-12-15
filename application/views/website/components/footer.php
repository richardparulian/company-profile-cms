<style>
    .my-widget-title {
        margin-top: 20px;
        font-family: 'Raleway', sans-serif;
        font-size: 16px;
        font-weight: bold;
        line-height: 28px;
        margin-bottom: 20px;
        word-wrap: break-word;
        text-transform: uppercase;
        color: #fff;
    }
</style>
<!-- Footer Main -->
<footer id="footer-main" class="container-fluid no-left-padding no-right-padding footer-main footer-main-2">
    <!-- Top Footer -->
    <div class="container-fluid no-left-padding no-right-padding top-footer">
        <!-- Container -->
        <div class="container">
            <!-- Row -->
            <div class="row">

                <!-- Widget Category -->
                <div class="col-md-2 col-sm-6 col-xs-6">
                    <aside class="widget widget_category">
                        <h3 class="widget-title">Company</h3>
                        <ul>
                            <li class="cat-item"><a href="<?= base_url('static-page/about'); ?>" title="About Us">About</a></li>
                            <li class="cat-item"><a href="<?= base_url('menu'); ?>" title="Our Menu">Menu</a></li>
                            <li class="cat-item"><a href="<?= base_url('blog'); ?>" title="Our Blog">Blog</a></li>
                        </ul>
                    </aside>
                </div><!-- Widget Category /- -->

                <!-- Widget Working Time -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <aside class="widget widget_workingtime">
                        <h3 class="widget-title">Working time</h3>
                        <div class="working-time-table">
                            <?= $configuration['company_working_time']; ?>
                        </div>
                    </aside>
                </div><!-- Widget Working Time -->

                <!-- Widget Instagram -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <aside class="widget widget_instagram">
                        <h3 class="widget-title">Join us our instagram</h3>
                        <div class="instafeed">
                            <?php foreach (array_slice($getInstagram, 0, 6) as $instagram) : ?>
                                <a href="<?= $instagram['instagram_url']; ?>" target="_blank"><img src="<?= base_url('assets/website/images/instagram/' . $instagram['instagram_image']); ?>" alt="<?= $instagram['instagram_image']; ?>" /></a>
                            <?php endforeach; ?>
                        </div>
                    </aside>
                </div><!-- Widget Instagram /- -->

                <!-- Widget About -->
                <div class="col-md-3 col-sm-6 col-xs-6">
                    <aside class="widget widget_about widget_category">
                        <h3 class="widget-title">Get in touch</h3>
                        <ul>
                            <li class="cat-item"><a href="<?= base_url('help-center'); ?>" title="Contact Us">Help Center</a></li>
                            <li class="cat-item"><a href="<?= base_url('contact-us'); ?>" title="Contact Us">Contact Us</a></li>
                        </ul>

                        <h3 class="my-widget-title">Connect with us</h3>
                        <aside class="widget widget_social">
                            <ul>
                                <?php
                                if ($configuration['company_facebook'] != "") {
                                    echo '<li><a href="' . $configuration['company_facebook'] . '" target="_blank" title="Facebook"><i class="fa fa-facebook"></i></a></li>';
                                }

                                if ($configuration['company_twitter'] != "") {
                                    echo '<li><a href="' . $configuration['company_twitter'] . '" target="_blank" title="Twitter"><i class="fa fa-twitter"></i></a></li>';
                                }

                                if ($configuration['company_youtube'] != "") {
                                    echo '<li><a href="' . $configuration['company_youtube'] . '" title="Youtube" target="_blank"><i class="fa fa-youtube"></i></a></li>';
                                }

                                if ($configuration['company_linkedin'] != "") {
                                    echo '<li><a href="' . $configuration['company_linkedin'] . '" title="Linkedin" target="_blank"><i class="fa fa-linkedin"></i></a></li>';
                                }
                                ?>
                            </ul>
                        </aside>
                    </aside>
                </div><!-- Widget About /- -->

            </div><!-- Row /- -->
        </div><!-- Container /- -->
    </div><!-- Top Footer -->
    <!-- Bottom Footer -->
    <div class="container-fluid bottom-footer">
        <p>&copy; Copyrights 2022 Milou Farm House - All Rights Reserved</p>
    </div><!-- Bottom Footer /- -->
</footer><!-- Footer Main /- -->

</div>

<!-- JQuery v1.12.4 -->
<script src="<?= base_url('assets/website/js/jquery-1.12.4.min.js'); ?>"></script>

<!-- Datepicker -->
<script src="<?= base_url('assets/website/js/datepicker/jquery-ui.min.js'); ?>"></script>

<!-- Library - Js -->
<script src="<?= base_url('assets/website/js/lib.js'); ?>"></script>

<!-- RS5.0 Core JS Files -->
<script type="text/javascript" src="<?= base_url('assets/website/revolution/js/jquery.themepunch.tools.min.js?rev=5.0'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/website/revolution/js/jquery.themepunch.revolution.min.js?rev=5.0'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/website/revolution/js/extensions/revolution.extension.video.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/website/revolution/js/extensions/revolution.extension.slideanims.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/website/revolution/js/extensions/revolution.extension.layeranimation.min.js'); ?>"></script>
<script type="text/javascript" src="<?= base_url('assets/website/revolution/js/extensions/revolution.extension.navigation.min.js'); ?>"></script>

<!-- Sweet Alert -->
<script type="text/javascript" src="<?= base_url('assets/website/js/sweetalert2.min.js'); ?>"></script>

<!-- Clipboard -->
<script src="<?= base_url('assets/website/js/clipboard.min.js'); ?>"></script>

<!-- Library - Theme JS -->
<script src="<?= base_url('assets/website/js/functions.js'); ?>"></script>

<!-- lazy load -->
<script src="<?= base_url('assets/website/js/jquery.bttrlazyloading.min.js'); ?>"></script>

<script>
    // navbar active
    var url = window.location.href;

    $('ul.navbar-nav li a').filter(function() {
        return this.href == url;
    }).parent().addClass('active');
    // end navbar active

    var active = false;

    $(document).ready(function() {

        var copySource = window.location.href;
        var copyButton = $(".copyButton");
        var clipboard = new ClipboardJS('.copyButton');

        clipboard.on('success', function(e) {
            var copyButtonMessage = "Text Copied!";
            e.clearSelection();
            copyButton.focus();
            if (active) {
                return;
            } else {
                copyMessageTooltip(copyButton, copyButtonMessage);
            }
        });
        clipboard.on('error', function(e) {
            var copyButtonMessage = "Press Ctrl+C to copy";
            if (active) {
                return;
            } else {
                copyMessageTooltip(copyButton, copyButtonMessage);
            }
        });
    });

    function copyMessageTooltip(copyButton, copyButtonMessage) {

        active = true;

        var tooltipVisibleTime = 2000; // How long to leave tooltip visible
        var tooltipHideTime = 100; // matches .inactive animation time

        // tooltip
        $('#copy_tooltip').text(copyButtonMessage).addClass('active');
        copyButton.attr('aria-describedby', 'copy_tooltip');

        setTimeout(function() {
            $('#copy_tooltip').removeClass('active').addClass('inactive');

            $('#copy_tooltip').replaceWith($('#copy_tooltip').clone(true));
            copyButton.removeAttr('aria-describedby');
            setTimeout(function() {
                $('#copy_tooltip').removeClass('inactive').text('');
                active = false;
            }, tooltipHideTime);
        }, tooltipVisibleTime);

    }

    // Sweet Alert
    const flashDataSuccess = $('.flash-data-success').data('flashdata');

    if (flashDataSuccess) {
        Swal.fire({
            title: 'Congratulations',
            text: 'Message ' + flashDataSuccess,
            type: 'success',
            icon: 'success'
        });
    }

    // Sweet Alert
    const flashDataError = $('.flash-data-error').data('flashdata');

    if (flashDataError) {
        Swal.fire({
            title: 'Sorry',
            text: 'Message ' + flashDataError,
            type: 'error',
            icon: 'error'
        });
    }

    $(function() {
        $('.bttrlazyloading').bttrlazyloading({
            delay: 1500
        });
    });
</script>

</body>

</html>