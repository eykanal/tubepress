<?php
require_once 'AbstractHttpTransportTest.php';
require_once BASE . '/sys/classes/org/tubepress/impl/http/transports/StreamsTransport.class.php';

class org_tubepress_impl_http_transports_StreamsTransportTest extends org_tubepress_impl_http_transports_AbstractHttpTransportTest {

    protected function _getSutInstance()
    {
       return new org_tubepress_impl_http_transports_StreamsTransport();
    }
}


