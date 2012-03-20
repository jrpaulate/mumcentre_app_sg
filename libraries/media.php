<?php

class Media {

    function create_id() {
        return md5(uniqid());
    }

    function splintr_convert($input, $dimension, $output) {
        $obj = & get_instance();
        $input = str_replace(" ", "\ ", $input);
        $exec_string = sprintf("ffmpeg -y -i %s -acodec libfaac -ar 44100 -ab 96k -vcodec libx264 -level 41 -crf 20 -bufsize 20000k -maxrate 25000k -g 250 -r 20 -s %s -coder 1 -flags +loop -cmp +chroma -partitions +parti4x4+partp8x8+partb8x8 -subq 7 -me_range 16 -keyint_min 25 -sc_threshold 40 -i_qfactor 0.71 -rc_eq 'blurCplx^(1-qComp)' -bf 16 -b_strategy 1 -bidir_refine 1 -refs 6 -deblockalpha 0 -deblockbeta 0 -f flv %s",
                $input, $dimension, $output);
        exec($exec_string);
    }

    function do_flv_convert($input, $dimension, $output) {
        $obj = & get_instance();
        $input = str_replace(" ", "\ ", $input);
        $exec_string = '/usr/local/bin/ffmpeg -i ' . $input . ' -ar 22050 -ab 32000 -f flv -s ' . $dimension . ' ' . $output;
        exec($exec_string);
    }

    function do_mp3_convert($input, $output) {
        $obj = & get_instance();
        $input = str_replace(" ", "\ ", $input);

        $exec_string = '/usr/local/bin/ffmpeg -i ' . $input . ' -ar 22050 -ab 64000 -f mp3 ' . $output;

        exec($exec_string);
    }

    function extract_frame($input, $output, $start_pos) {
        $obj = & get_instance();
        $exec_string = 'ffmpeg -i ' . $input . ' -r 1  -ss ' . $start_pos . ' -f image2 ' . $output;
        
        exec($exec_string);
    }

    function get_duration($input) {
        $extension = "ffmpeg";
        $extension_soname = $extension . "." . PHP_SHLIB_SUFFIX;
        $extension_fullname = PHP_EXTENSION_DIR . "/" . $extension_soname;

        if (!extension_loaded($extension)) {
            dl($extension_soname) or die("Can't load extension $extension_fullname\n");
            return false;
        } else {
            $movie = new ffmpeg_movie($input, false);
            return $movie->getDuration();
        }
    }

    function get_frame_height($input) {
        $extension = "ffmpeg";
        $extension_soname = $extension . "." . PHP_SHLIB_SUFFIX;
        $extension_fullname = PHP_EXTENSION_DIR . "/" . $extension_soname;

        if (!extension_loaded($extension)) {
            dl($extension_soname) or die("Can't load extension $extension_fullname\n");
            return false;
        } else {
            $movie = new ffmpeg_movie($input, false);
            return $movie->getFrameHeight();
        }
    }

    function get_frame_width($input) {
        $extension = "ffmpeg";
        $extension_soname = $extension . "." . PHP_SHLIB_SUFFIX;
        $extension_fullname = PHP_EXTENSION_DIR . "/" . $extension_soname;

        if (!extension_loaded($extension)) {
            dl($extension_soname) or die("Can't load extension $extension_fullname\n");
            return false;
        } else {
            $movie = new ffmpeg_movie($input, false);
            return $movie->getFrameWidth();
        }
    }

    function smart_resize_image($file, $width = 0, $height = 0, $proportional = false, $output = 'file', $delete_original = true, $use_linux_commands = false) {
        if ($height <= 0 && $width <= 0) {
            return false;
        }

        $info = getimagesize($file);
        $image = '';

        $final_width = 0;
        $final_height = 0;
        list($width_old, $height_old) = $info;

        if ($proportional) {
            if ($width == 0)
                $factor = $height / $height_old;
            elseif ($height == 0)
                $factor = $width / $width_old;
            else
                $factor = min($width / $width_old, $height / $height_old);

            $final_width = round($width_old * $factor);
            $final_height = round($height_old * $factor);
        }
        else {
            $final_width = ( $width <= 0 ) ? $width_old : $width;
            $final_height = ( $height <= 0 ) ? $height_old : $height;
        }
        
        switch ($info[2]) {
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($file);
                break;
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($file);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($file);
                break;
            default:
                return false;
        }

        $image_resized = imagecreatetruecolor( $final_width, $final_height );

        if (($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG)) {
            $trnprt_indx = imagecolortransparent($image);

            // If we have a specific transparent color
            if ($trnprt_indx >= 0) {

                // Get the original image's transparent color's RGB values
                $trnprt_color = imagecolorsforindex($image, $trnprt_indx);

                // Allocate the same color in the new image resource
                $trnprt_indx = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);

                // Completely fill the background of the new image with allocated color.
                imagefill($image_resized, 0, 0, $trnprt_indx);

                // Set the background color for new image to transparent
                imagecolortransparent($image_resized, $trnprt_indx);

                imagetruecolortopalette($image_resized, true, imagecolorstotal($image));
            }
            // Always make a transparent background color for PNGs that don't have one allocated already
            elseif ($info[2] == IMAGETYPE_PNG) {

                // Turn off transparency blending (temporarily)
                imagealphablending($image_resized, false);

                // Create a new transparent color for image
                $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);

                // Completely fill the background of the new image with allocated color.
                imagefill($image_resized, 0, 0, $color);

                // Restore transparency blending
                imagesavealpha($image_resized, true);
            }
        }

        imagecopyresampled($image_resized, $image, 0, 0, 0, 0, $final_width, $final_height, $width_old, $height_old);

        if ($delete_original) {
            if ($use_linux_commands)
                exec('rm ' . $file);
            else
                @unlink($file);
        }

        switch (strtolower($output)) {
            case 'browser':
                $mime = image_type_to_mime_type($info[2]);
                header("Content-type: $mime");
                $output = NULL;
                break;
            case 'file':
                $output = $file;
                break;
            case 'return':
                return $image_resized;
                break;
            default:
                break;
        }

//        switch ( $info[2] ) {
//            case IMAGETYPE_GIF:
//                imagegif($image_resized, $output);
//                break;
//            case IMAGETYPE_JPEG:
//                imagejpeg($image_resized, $output);
//                break;
//            case IMAGETYPE_PNG:
//                imagepng($image_resized, $output);
//                break;
//            default:
//                return false;
//        }

        imagejpeg($image_resized, $output, 90);

        return true;
    }

    function smart_thumb_image($file, $width = 0, $height = 0, $thumb_width = 100, $thumb_height = 100, $proportional = false, $output = 'file', $delete_original = true, $use_linux_commands = false) {
        if ($height <= 0 && $width <= 0) {
            return false;
        }

//        $thumb_width = 100;
//        $thumb_height = 100;
        $info = getimagesize($file);
        $image = '';

        $final_width = 0;
        $final_height = 0;
        list($width_old, $height_old) = $info;

        if ($proportional) {
            if ($width == 0)
                $factor = $height / $height_old;
            elseif ($height == 0)
                $factor = $width / $width_old;
            else
                $factor = min($width / $width_old, $height / $height_old);

            $final_width = round($width_old * $factor);
            $final_height = round($height_old * $factor);
        }
        else {
            $final_width = ( $width <= 0 ) ? $width_old : $width;
            $final_height = ( $height <= 0 ) ? $height_old : $height;
        }

        switch ($info[2]) {
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($file);
                break;
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($file);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($file);
                break;
            default:
                return false;
        }

        $image_resized = imagecreatetruecolor($thumb_width, $thumb_height);
        $bg_color = ImageColorAllocate($image_resized, 255, 255, 255);
//        $bg_color = ImageColorAllocate($image_resized, 58, 56, 53);
        imagefill($image_resized, 0, 0, $bg_color);

        if (($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG)) {
            $trnprt_indx = imagecolortransparent($image);

            // If we have a specific transparent color
            if ($trnprt_indx >= 0) {

                // Get the original image's transparent color's RGB values
                $trnprt_color = imagecolorsforindex($image, $trnprt_indx);

                // Allocate the same color in the new image resource
                $trnprt_indx = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);

                // Completely fill the background of the new image with allocated color.
                imagefill($image_resized, 0, 0, $trnprt_indx);

                // Set the background color for new image to transparent
                imagecolortransparent($image_resized, $trnprt_indx);

                imagetruecolortopalette($image_resized, true, imagecolorstotal($image));
            }
            // Always make a transparent background color for PNGs that don't have one allocated already
            elseif ($info[2] == IMAGETYPE_PNG) {

                // Turn off transparency blending (temporarily)
                imagealphablending($image_resized, false);

                // Create a new transparent color for image
                $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);

                // Completely fill the background of the new image with allocated color.
                imagefill($image_resized, 0, 0, $color);

                // Restore transparency blending
                imagesavealpha($image_resized, true);
            }
        }

        imagecopyresampled($image_resized, $image, ($thumb_width - $final_width) / 2, ($thumb_height - $final_height) / 2, 0, 0, $final_width, $final_height, $width_old, $height_old);

        if ($delete_original) {
            if ($use_linux_commands)
                exec('rm ' . $file);
            else
                @unlink($file);
        }

        switch (strtolower($output)) {
            case 'browser':
                $mime = image_type_to_mime_type($info[2]);
                header("Content-type: $mime");
                $output = NULL;
                break;
            case 'file':
                $output = $file;
                break;
            case 'return':
                return $image_resized;
                break;
            default:
                break;
        }

        imagejpeg($image_resized, $output, 100);

        return true;
    }

    function smart_thumb_image_color($file, $width = 0, $height = 0, $thumb_width = 100, $thumb_height = 100, $proportional = false, $background = array(255,255,55), $output = 'file', $delete_original = true, $use_linux_commands = false) {
        if ($height <= 0 && $width <= 0) {
            return false;
        }

        $info = getimagesize($file);
        $image = '';

        $final_width = 0;
        $final_height = 0;
        list($width_old, $height_old) = $info;

        if ($proportional) {
            if ($width == 0)
                $factor = $height / $height_old;
            elseif ($height == 0)
                $factor = $width / $width_old;
            else
                $factor = min($width / $width_old, $height / $height_old);

            $final_width = round($width_old * $factor);
            $final_height = round($height_old * $factor);
        }
        else {
            $final_width = ( $width <= 0 ) ? $width_old : $width;
            $final_height = ( $height <= 0 ) ? $height_old : $height;
        }

        switch ($info[2]) {
            case IMAGETYPE_GIF:
                $image = imagecreatefromgif($file);
                break;
            case IMAGETYPE_JPEG:
                $image = imagecreatefromjpeg($file);
                break;
            case IMAGETYPE_PNG:
                $image = imagecreatefrompng($file);
                break;
            default:
                return false;
        }
//        echo $final_width.'x'.$final_height.' - ';
        $image_resized = imagecreatetruecolor($thumb_width, $thumb_height);
        $bg_color = ImageColorAllocate($image_resized, $background[0], $background[1], $background[2]);
        imagefill($image_resized, 0, 0, $bg_color);

        if (($info[2] == IMAGETYPE_GIF) || ($info[2] == IMAGETYPE_PNG)) {
            $trnprt_indx = imagecolortransparent($image);

            // If we have a specific transparent color
            if ($trnprt_indx >= 0) {

                // Get the original image's transparent color's RGB values
                $trnprt_color = imagecolorsforindex($image, $trnprt_indx);

                // Allocate the same color in the new image resource
                $trnprt_indx = imagecolorallocate($image_resized, $trnprt_color['red'], $trnprt_color['green'], $trnprt_color['blue']);

                // Completely fill the background of the new image with allocated color.
                imagefill($image_resized, 0, 0, $trnprt_indx);

                // Set the background color for new image to transparent
                imagecolortransparent($image_resized, $trnprt_indx);

                imagetruecolortopalette($image_resized, true, imagecolorstotal($image));
            }
            // Always make a transparent background color for PNGs that don't have one allocated already
            elseif ($info[2] == IMAGETYPE_PNG) {

                // Turn off transparency blending (temporarily)
                imagealphablending($image_resized, false);

                // Create a new transparent color for image
                $color = imagecolorallocatealpha($image_resized, 0, 0, 0, 127);

                // Completely fill the background of the new image with allocated color.
                imagefill($image_resized, 0, 0, $color);

                // Restore transparency blending
                imagesavealpha($image_resized, true);
            }
        }

        imagecopyresampled($image_resized, $image, ($thumb_width - $final_width) / 2, ($thumb_height - $final_height) / 2, 0, 0, $final_width, $final_height, $width_old, $height_old);

        if ($delete_original) {
            if ($use_linux_commands)
                exec('rm ' . $file);
            else
                @unlink($file);
        }

        switch (strtolower($output)) {
            case 'browser':
                $mime = image_type_to_mime_type($info[2]);
                header("Content-type: $mime");
                $output = NULL;
                break;
            case 'file':
                $output = $file;
                break;
            case 'return':
                return $image_resized;
                break;
            default:
                break;
        }

        imagejpeg($image_resized, $output, 100);

        return true;
    }

    function compute_dimension($height, $width, $height_old, $width_old, $proportional = false) {
        if ($height <= 0 && $width <= 0) {
            return false;
        }

        $final_width = 0;
        $final_height = 0;

        if ($proportional) {
            if ($width == 0)
                $factor = $height / $height_old;
            elseif ($height == 0)
                $factor = $width / $width_old;
            else
                $factor = min($width / $width_old, $height / $height_old);

            $final_width = round($width_old * $factor);
            $final_height = round($height_old * $factor);
        }
        else {
            $final_width = ( $width <= 0 ) ? $width_old : $width;
            $final_height = ( $height <= 0 ) ? $height_old : $height;
        }

        if ($final_height % 2 != 0) {
            $final_height += 1;
        }

        if ($final_width % 2 != 0) {
            $final_width += 1;
        }

        return $final_width . "x" . $final_height;
    }

    function create_thumb($input, $thumb_size, $output) {
        list($width, $height) = getimagesize($input);

        $image_src = imagecreatefromjpeg($input) or die("Error: Cannot find image!" . $input);

        if ($width > $height)
            $biggest_size = $width;
        else
            $biggest_size = $height;

        $crop_percent = .5;
        $crop_width = $biggest_size * $crop_percent;
        $crop_height = $biggest_size * $crop_percent;

        $image_x = ($width - $crop_width ) / 2;
        $image_y = ($height - $crop_height ) / 2;

        $the_thumb = imagecreatetruecolor($thumb_size, $thumb_size);

        imagecopyresampled($the_thumb, $image_src, 0, 0, $image_x, $image_y, $thumb_size, $thumb_size, $crop_width, $crop_height);

        imagejpeg($the_thumb, $output);
        imagedestroy($the_thumb);
    }

}
?>
