<?php

if(!rex_config::has("yrewrite_url_redirect")) {
    rex_config::set("yrewrite_url_redirect", "force_trailing_slash", 1);
    rex_config::set("yrewrite_url_redirect", "force_forward", 1);
}
