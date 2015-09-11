<?php

class Image {

    public $newImage;
    public $newFilePath;
    public $mime;
    public $file_path;
    public $pathToUpload;

    public function checkImage($imgFile) {
        if (isset($imgFile)) {
            $check = getimagesize($imgFile["tmp_name"]);
            if ($check !== false) {
                return TRUE;
            }
        }
        return FALSE; //return flase for file not selected and file is not an image.
    }

    public function imageExists($file_path) {
        if (!file_exists($file_path)) {
            return TRUE;
        } else {
            return FALSE;
        }
    }

    public function uploadResize($imgFile, $pathToUpload) {
        $this->pathToUpload = $pathToUpload;
        $this->file_path = rootDir . '/' . $pathToUpload . basename($imgFile["name"]);
        if ($this->imageExists($this->file_path)) {
            if (move_uploaded_file($imgFile["tmp_name"], $this->file_path)) {
                return 'ok';
            } else {
                return 'no-upload';
            }
        } else {
            return 'same';
        }
    }

    public function getMime($imgPath) {
        $mime = getimagesize($imgPath);
        if ($mime['mime'] == 'image/png') {
            $src_img = imagecreatefrompng($imgPath);
        } elseif ($mime['mime'] == 'image/jpg') {
            $src_img = imagecreatefromjpeg($imgPath);
        } elseif ($mime['mime'] == 'image/jpeg') {
            $src_img = imagecreatefromjpeg($imgPath);
        } elseif ($mime['mime'] == 'image/pjpeg') {
            $src_img = imagecreatefromjpeg($imgPath);
        }
        return array($src_img, $mime);
    }

    public function resizeImage($imgWidth) {
        $data = $this->getMime($this->file_path);
        $src_img = $data[0];
        $this->mime = $data [1];
        $img_width = imageSX($src_img);
        $img_height = imageSY($src_img);
        $new_size = $img_height / $img_width;
        $img_width_new = $imgWidth;
        $img_height_new = $img_width_new * $new_size;
        $this->newImage = ImageCreateTrueColor($img_width_new, $img_height_new);
        $background = imagecolorallocate($this->newImage, 0, 0, 0);
        imagecolortransparent($this->newImage, $background);
        imagealphablending($this->newImage, false);
        imagesavealpha($this->newImage, true);
        imagecopyresampled($this->newImage, $src_img, 0, 0, 0, 0, $img_width_new, $img_height_new, $img_width, $img_height); // New save location
        $this->newFilePath = rootDir . '/' . $this->pathToUpload . basename($this->file_path);
    }

    public function createThumbnail($imgPath, $finalPath) {
        $data = $this->getMime($imgPath);
        $src_img = $data[0];
        $mime = $data[1];
        $img_width = imageSX($src_img);
        $img_height = imageSY($src_img);
        $new_size = ($img_width + $img_height) / ($img_width * ($img_height / 80));
        $img_width_new = $img_width * $new_size;
        $img_height_new = $img_height * $new_size;
        $new_image = ImageCreateTrueColor($img_width_new, $img_height_new);
        $background = imagecolorallocate($new_image, 0, 0, 0);
        imagecolortransparent($new_image, $background);
        imagealphablending($new_image, false);
        imagesavealpha($new_image, true);
        imagecopyresampled($new_image, $src_img, 0, 0, 0, 0, $img_width_new, $img_height_new, $img_width, $img_height); // New save location
        $new_file_path = $finalPath . basename($imgPath);
        return $this->createImage($new_image, $new_file_path, $mime);
    }

    public function cropImage($imgPath, $coordX, $coordY, $coordW, $coordH, $newWidth, $newHeight, $pathToUpload) {
        $data = $this->getMime($imgPath);
        $src_img = $data[0];
        $mime = $data [1];
        $img_width_new = $newWidth;
        $img_height_new = $newHeight;
        $new_image = ImageCreateTrueColor($img_width_new, $img_height_new);
        imagecopyresampled($new_image, $src_img, 0, 0, $coordX, $coordY, $coordW, $coordH, $img_width_new, $img_height_new); // New save location
        return $this->createImage($new_image, $pathToUpload . basename($imgPath), $mime);
    }

    public function makeImage($filename = null, $folder = NULL) {
        if ($this->mime['mime'] == 'image/png') {
            $result = imagepng($this->newImage, $this->newFilePath, 9);
        } elseif ($this->mime['mime'] == 'image/jpg') {
            $result = imagejpeg($this->newImage, $this->newFilePath, 80);
        } elseif ($this->mime['mime'] == 'image/jpeg') {
            $result = imagejpeg($this->newImage, $this->newFilePath, 80);
        } elseif ($this->mime['mime'] == 'image/pjpeg') {
            $result = imagejpeg($this->newImage, $this->newFilePath, 80);
        }
        if (!empty($folder) && !empty($filename)) {
            return $folder . $filename;
        } else {
            return $this->pathToUpload . basename($this->file_path);
        }
    }

    public function createImage($new_image, $new_file_path, $mime) {
        if ($mime['mime'] == 'image/png') {
            $result = imagepng($new_image, $new_file_path, 9);
        } elseif ($mime['mime'] == 'image/jpg') {
            $result = imagejpeg($new_image, $new_file_path, 80);
        } elseif ($mime['mime'] == 'image/jpeg') {
            $result = imagejpeg($new_image, $new_file_path, 80);
        } elseif ($mime['mime'] == 'image/pjpeg') {
            $result = imagejpeg($new_image, $new_file_path, 80);
        }
        return $new_file_path;
    }

}
