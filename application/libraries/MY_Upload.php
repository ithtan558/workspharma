<?php if ( ! defined('BASEPATH')) exit('No direct script access allowed');

class MY_Upload extends CI_Upload {

    public function my_do_upload($field = 'userfile'){
        if($this->makeDir($this->upload_path)){
            return $this->do_upload($field);
        }
    }

    public function makeDir($target) {
        // from php.net/mkdir user contributed notes
        $target = str_replace( '//', '/', $target );
        if ( file_exists( $target ) )
            return @is_dir( $target );

        // Attempting to create the directory may clutter up our display.
        if ( @mkdir( $target ) ) {
            $stat = @stat( dirname( $target ) );
            $dir_perms = $stat['mode'] & 0007777;  // Get the permission bits.
            @chmod( $target, $dir_perms );
            return true;
        } elseif ( is_dir( dirname( $target ) ) ) {
            return false;
        }

        // If the above failed, attempt to create the parent node, then try again.
        if ( ( $target != '/' ) && ( self::makeDir( dirname( $target ) ) ) )
            return self::makeDir( $target );

        return false;
    }
}
