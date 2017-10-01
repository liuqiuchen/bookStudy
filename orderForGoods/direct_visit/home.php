<?php
require_once('../common/includes/Page.inc');

$home_page = new Page();
$home_page->content = "<p>Welcome to the home of TLA Consulting.
                        Please take some time to get to know us.</p>
                        <p>We specialize in serving your business needs and hope
                        to hear from you soon.</p>";
$home_page->Display();

