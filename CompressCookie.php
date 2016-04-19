<?php

class CompressCookie
{

    public function setcookie($label, $content)
    {
        setcookie($label, $this->compress($content), time()+3600, '/');
    }

    public function getcookie($label)
    {
        return $this->uncompress($_COOKIE[$label]);
    }

    public function compress($content, $jsonEncode = true)
    {
        if ( is_array($content) or is_object($content) ) {
            if ($jsonEncode) {
                $test = json_encode($content);
            }
            else {
                $test = serialize($content);
            }
            return base64_encode( gzcompress( $test ) );
        }
        else {
            return base64_encode( gzcompress($content) );
        }
    }

    public function uncompress($content)
    {
        $uncompressed = gzuncompress( base64_decode($content) );

        if ( @unserialize($uncompressed) ) {
            return unserialize($uncompressed);
        }
        elseif ( @json_decode($uncompressed, true) ) {
            return json_decode($uncompressed);
        }
        else {
            return $uncompressed;
        }
    }

}