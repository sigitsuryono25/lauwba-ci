<?php if (!defined('BASEPATH')) exit('No direct script access allowed');

// ----------------------------------------------------------------------
// Convert ke WebP + auto compress
// ----------------------------------------------------------------------
function convert_to_webp_auto($source_path, $target_path = null)
{
    if (!file_exists($source_path)) {
        return false;
    }

    if ($target_path === null) {
        $info = pathinfo($source_path);
        $target_path = $info['dirname'] . '/' . $info['filename'] . '.webp';
    }

    $size = filesize($source_path);
    $size_kb = $size / 1024;
    $size_mb = $size / (1024 * 1024);

    if ($size_mb > 1) {
        $quality = 30;      // >1MB
    } elseif ($size_kb > 100) {
        $quality = 50;      // 100KB–1MB
    } else {
        $quality = 75;      // <100KB
    }

    $img_type = exif_imagetype($source_path);

    switch ($img_type) {
        case IMAGETYPE_JPEG:
            $img = imagecreatefromjpeg($source_path); break;
        case IMAGETYPE_PNG:
            $img = imagecreatefrompng($source_path);
            imagepalettetotruecolor($img);
            imagealphablending($img, true);
            imagesavealpha($img, true);
            break;
        case IMAGETYPE_WEBP:
            $img = imagecreatefromwebp($source_path); break;
        default:
            return false;
    }

    imagewebp($img, $target_path, $quality);
    imagedestroy($img);

    return $target_path;
}



// ----------------------------------------------------------------------
// Generate beberapa ukuran WebP (responsive images)
// ----------------------------------------------------------------------
function generate_responsive_images($source_path, $sizes = [480, 720, 1080, 1440])
{
    if (!file_exists($source_path)) {
        return false;
    }

    list($width, $height) = getimagesize($source_path);
    $ratio = $height / $width;

    $info = pathinfo($source_path);
    $dirname = $info['dirname'];
    $basename = $info['filename'];

    $results = [];

    foreach ($sizes as $new_width) {
        if ($new_width > $width) continue;

        $new_height = intval($new_width * $ratio);
        $target_path = "{$dirname}/{$basename}-{$new_width}.webp";

        resize_and_convert_webp($source_path, $target_path, $new_width, $new_height);
        $results[$new_width] = $target_path;
    }

    return $results;
}



// ----------------------------------------------------------------------
// Resize → convert → compress
// ----------------------------------------------------------------------
function resize_and_convert_webp($source_path, $target_path, $new_width, $new_height)
{
    list($width, $height, $type) = getimagesize($source_path);

    switch ($type) {
        case IMAGETYPE_JPEG: $src = imagecreatefromjpeg($source_path); break;
        case IMAGETYPE_PNG:
            $src = imagecreatefrompng($source_path);
            imagepalettetotruecolor($src);
            imagealphablending($src, true);
            imagesavealpha($src, true);
            break;
        case IMAGETYPE_WEBP: $src = imagecreatefromwebp($source_path); break;
        default: return false;
    }

    $tmp = imagecreatetruecolor($new_width, $new_height);
    imagecopyresampled($tmp, $src, 0, 0, 0, 0, $new_width, $new_height, $width, $height);

    imagewebp($tmp, $target_path, 70);

    imagedestroy($tmp);
    imagedestroy($src);

    return $target_path;
}



// ----------------------------------------------------------------------
// Generate picture + srcset HTML
// ----------------------------------------------------------------------
function generate_srcset_tag($base_url_path, $sizes_array)
{
    $srcset = [];

    foreach ($sizes_array as $size => $path) {
        $srcset[] = base_url($path) . " {$size}w";
    }

    $srcset_str = implode(", ", $srcset);

    $first_src = reset($sizes_array);

    return "
<picture>
    <source type='image/webp' srcset=\"{$srcset_str}\" sizes='100vw'>
    <img src=\"" . base_url($first_src) . "\" alt='image'>
</picture>
";
}