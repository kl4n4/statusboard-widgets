<?php

namespace Updatemi;

class Api {

    const ENDPOINT = 'https://www.updatemi.com/api';

    /*
     * ToDo: implement API class properly
     */
    public function getLatestUpdates($limit) {
        return @json_decode(file_get_contents(self::ENDPOINT . '/feed?status=enabled&limit=' . $limit . '&sort=-releaseDate'), true);
    }
}
