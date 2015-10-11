<?php

namespace Updatemi;

class Api {

    const ENDPOINT = 'https://www.updatemi.com/api';

    /*
     * ToDo: implement API class properly
     */
    public function getLatestUpdates() {
        return @json_decode(file_get_contents(self::ENDPOINT . '/feed?status=enabled&limit=3&sort=-releaseDate'), true);
    }
}
