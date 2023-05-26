<?php

namespace App\Http;

use finfo;

class ImageGPT
{
    private $file;
    private $name;
    private $minSize;
    private $maxSize;
    private $allowedTypes = [];
    private $minWidth;
    private $maxWidth;
    private $minHeight;
    private $maxHeight;
    private $storageFolder;
    private $storagePermission;

    public function __construct($file)
    {
        $this->file = $file;
    }

    public function setName($name)
    {
        $this->name = $name;
        return $this;
    }

    public function setSize($min, $max)
    {
        $this->minSize = $min;
        $this->maxSize = $max;
        return $this;
    }

    public function setMime(array $mimeTypes)
    {
        $this->allowedTypes = $mimeTypes;
        return $this;
    }

    public function setDimension($width, $height)
    {
        // $this->minWidth = $width;
        $this->maxWidth = $width;
        // $this->minHeight = $height;
        $this->maxHeight = $height;
        return $this;
    }

    public function setStorage($folderName, $permission = null)
    {
        $this->storageFolder = $folderName;
        $this->storagePermission = $permission;
        return $this;
    }

    public function getName()
    {
        return $this->name;
    }

    public function getSize()
    {
        return $this->file['size'];
    }

    public function getMime()
    {
        return $this->file['type'];
    }

    public function getWidth()
    {
        $imageInfo = $this->getImageInfo();
        return $imageInfo ? $imageInfo[0] : null;
    }

    public function getHeight()
    {
        $imageInfo = $this->getImageInfo();
        return $imageInfo ? $imageInfo[1] : null;
    }

    public function getStorage()
    {
        return $this->storageFolder;
    }

    public function getPath()
    {
        return $this->storageFolder . '/' . $this->generateFileName();
    }

    public function getJson()
    {
        return json_encode([
            'name' => $this->getName(),
            'size' => $this->getSize(),
            'mime' => $this->getMime(),
            'width' => $this->getWidth(),
            'height' => $this->getHeight(),
            'storage' => $this->getStorage(),
            'path' => $this->getPath()
        ]);
    }

    public function upload()
    {
        if (!$this->validateFile()) {
            return false;
        }

        $destination = $this->getStorage();

        if (!is_dir($destination)) {
            mkdir($destination, $this->storagePermission, true);
        }

        $newFileName = $this->generateFileName();

        $uploaded = move_uploaded_file($this->file['tmp_name'], $destination . '/' . $newFileName);

        if ($uploaded) {
            return $newFileName;
        } else {
            return false;
        }
    }

    private function validateFile()
    {
        if (!isset($this->file['error']) || is_array($this->file['error'])) {
            return false;
        }

        if ($this->file['error'] !== UPLOAD_ERR_OK) {
            return false;
        }

        if (!is_uploaded_file($this->file['tmp_name'])) {
            return false;
        }

        if (!$this->checkFileSize()) {
            return false;
        }

        if (!$this->checkFileType()) {
            return false;
        }

        if (!$this->checkImageSize()) {
            return false;
        }

        return true;
    }

    private function checkFileSize()
    {
        $sizeInBytes = $this->file['size'];
        return ($this->minSize === null || $sizeInBytes >= $this->minSize) && ($this->maxSize === null || $sizeInBytes <= $this->maxSize);
    }

    private function checkFileType()
    {
        if (empty($this->allowedTypes)) {
            return true;
        }

        $fileInfo = new finfo(FILEINFO_MIME_TYPE);
        $mimeType = $fileInfo->file($this->file['tmp_name']);

        foreach ($this->allowedTypes as $type) {
            if ($mimeType === $type) {
                return true;
            }
        }

        return false;
    }

    private function checkImageSize()
    {
        $imageInfo = $this->getImageInfo();

        if (!$imageInfo) {
            return false;
        }

        $width = $imageInfo[0];
        $height = $imageInfo[1];

        return ($this->minWidth === null || $width >= $this->minWidth) &&
               ($this->maxWidth === null || $width <= $this->maxWidth) &&
               ($this->minHeight === null || $height >= $this->minHeight) &&
               ($this->maxHeight === null || $height <= $this->maxHeight);
    }

    private function getImageInfo()
    {
        if (!function_exists('getimagesize')) {
            return false;
        }

        return getimagesize($this->file['tmp_name']);
    }

    private function generateFileName()
    {
        $extension = pathinfo($this->file['name'], PATHINFO_EXTENSION);

        if ($this->name !== null) {
            $newFileName = $this->name . '.' . $extension;
        } else {
            $newFileName = uniqid() . '.' . $extension;
        }

        return $newFileName;
    }
}
