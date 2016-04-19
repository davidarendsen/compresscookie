<?php

/**
 * @package CompressCookie
 * @author David Arendsen
 */
class CompressCookie
{

    /**
     * @param string $label Set key for the cookie
     * @param mixed|bool $content The content for the cookie
     */
    public function setcookie($label, $content)
    {
        setcookie($label, $this->compress($content), time()+3600, '/');
    }

    /**
     * @param string $label Get cookie by this key
     * @return mixed|bool Uncompressed content of cookie
     */
    public function getcookie($label)
    {
        if ( isset($_COOKIE[$label]) ) {
            return $this->uncompress($_COOKIE[$label]);
        }
        else {
            return false;
        }
    }

    /**
     * @param string $content Compress this content
     * @param bool $jsonEncode If the content has to be JSON encoded or serialized
     * @return string Compressed content (base64 encoded)
     */
    public function compress($content, $jsonEncode = true)
    {
        if ( is_array($content) or is_object($content) ) {
            if ($jsonEncode) {
                $serialized = json_encode($content);
            }
            else {
                $serialized = serialize($content);
            }
            return base64_encode( gzcompress( $serialized ) );
        }
        else {
            return base64_encode( gzcompress($content) );
        }
    }

    /**
     * @param string $content Compress this content
     * @return string|array|object Uncompressed content
     */
    public function uncompress($content)
    {
        $uncompressed = gzuncompress( base64_decode($content) );

        if ( @unserialize($uncompressed) ) {
            return unserialize($uncompressed);
        }
        elseif ( @json_decode($uncompressed) ) {
            return json_decode($uncompressed);
        }
        else {
            return $uncompressed;
        }
    }

}