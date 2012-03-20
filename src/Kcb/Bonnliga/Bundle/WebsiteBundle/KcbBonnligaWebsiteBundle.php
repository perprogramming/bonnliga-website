<?php

namespace Kcb\Bonnliga\Bundle\WebsiteBundle;

use Symfony\Component\HttpKernel\Bundle\Bundle;

class KcbBonnligaWebsiteBundle extends Bundle {

    public function boot() {
        setlocale(LC_ALL, 'de_DE.utf8', 'de_DE');
    }

}