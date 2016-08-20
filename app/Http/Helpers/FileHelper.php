<?php

/*
  |@author: Alankar More
  |
  |--------------------------------------------------------------------------
  | Helper for file operations such as renaming,writing,uploading etc.
  |--------------------------------------------------------------------------
  | Each helper function will provide some basic functionalities.
  |
 */

namespace App\Http\Helpers;

use Config;

class FileHelper
{

    /**
     *
     * Setting new file name
     *
     * @var string
     */
    public $_fileName;

    /**
     * Uploaded file instance
     *
     * @var Object uploaded file
     */
    public $_file;

    /**
     * Source file name
     * @var string
     */
    public $sourceFilename;

    /**
     * Soruce file path
     *
     * @var string
     */
    public $sourceFilepath;

    /**
     * Destination path to save file
     *
     * @var string
     */
    public $destinationPath;

    /**
     * If we need to provide new name to image
     *
     * @var string
     */
    public $newNameForFile = null;

    public $course = array('small' => array('568X180'));

    /**
     * Setting instance of uploaded file
     *
     */
    public function __construct($fileInstance = null)
    {
        if (!empty($fileInstance)) {
            $this->_file = $fileInstance;
        }
    }

    /**
     * uploading file to destination
     *
     * @return boolean
     * @throws exception Exception
     */
    public function upload($uploadPath)
    {
        try {
            return $this->_file->move(public_path('uploads/' . $uploadPath), $this->getFileName());
        } catch (Exception $e) {
            throw new Exception($e->getMessage());
        }
    }

    /**
     * Set user defined file name
     *
     * @var string $filename
     */
    public function setFileName($filename)
    {
        $this->_fileName = $filename . "." . $this->_getFileExtension();
    }

    /**
     * Get file name. if it has been changed
     *
     * @return string
     */
    public function getFileName()
    {
        return ($this->_fileName) ? $this->_fileName : $this->_file->getClientOriginalName();
    }

    /**
     * Get file extension for uploaded file
     *
     * @return string
     */
    public function _getFileExtension()
    {
        return $this->_file->getClientOriginalExtension();
    }

    /**
     * removing file
     *
     * @return boolean
     */
    public function removeFile($fileName)
    {
        $file = public_path($fileName);
        return (file_exists($file)) ? unlink($file) : false;
    }

    /**
     * Crropping image according to the provided image dimensions.
     *
     * @param array $imageDimensions
     * @param string $key
     * @return string thumbnail image name
     */
    private function _cropImage($imageDimensions, $key)
    {
        $sourceImage = $this->sourceFilepath . $this->sourceFilename;
        $widthHeight = $imageDimensions[0] . 'X' . $imageDimensions[1];

        $widthAuto = $this->sourceFilepath . 'thumb_width_auto_' . $imageDimensions[0] . '_' . $this->sourceFilename;
        $thumb = $this->destinationPath . $this->sourceFilename;
        $command = '/usr/bin/convert ' . $sourceImage . ' -resize ' . $imageDimensions[0] . ' x ' . $widthAuto;
        if ($key == 'small') {
            $command = '/usr/bin/convert ' . $sourceImage . ' -resize x' . $imageDimensions[1] . ' ' . $widthAuto;
        }
        exec($command);

        $newImageSize = getimagesize($widthAuto);

        if ($key == 'small') {
            if ($newImageSize[0] >= $imageDimensions[0]) {
                $ratio = round(($newImageSize[0] - $imageDimensions[0]) / 2);
                // if width >= expected width and height is not maching.
                $command = '/usr/bin/convert ' . $widthAuto . ' -crop ' . $imageDimensions[0] . 'x' . $imageDimensions[1] . '+' . $ratio . ' ! -quality 100' . ' ' . $thumb;
                exec($command);
            } else {
                copy($widthAuto, $thumb);
            }
        } else {
            if ($newImageSize[1] >= $imageDimensions[1]) {
                $ratio = round(($newImageSize[1] - $imageDimensions[1]) / 2);
                // if width >= expected width and height is not maching.
                $command = '/usr/bin/convert ' . $widthAuto . ' -shave 0x' . $ratio . ' -quality 100' . ' ' . $thumb;
                exec($command);
            } else {
                copy($widthAuto, $thumb);
            }
        }

        unlink($widthAuto);

        return $this->sourceFilename;
    }

    /**
     * Resizing image as per the given image ratios.
     *
     * @param string $entityName
     * @param boolean $checkDir
     * @return string
     */
    public function resizeImage($entityName, $checkDir = false)
    {
        $sourceImage = $this->sourceFilepath . $this->sourceFilename;
        if ($checkDir) {
            if (!file_exists($this->destinationPath)) {
                mkdir($this->destinationPath, 0777, TRUE);
                chmod($this->destinationPath, 0777);
            }
        }

        $originalImageSize = getimagesize($sourceImage);
        foreach ($this->$entityName as $key => $dimension) {
            foreach ($dimension as $value) {
                $imageDimensions = explode("X", $value);
                if ($originalImageSize[0] >= $imageDimensions[0] || $originalImageSize[1] >= $imageDimensions[1]) {
                    $thumbnail = $this->_cropImage($imageDimensions, $key);
                    if (!empty($thumbnail)) {
                        return $thumbnail;
                    } else {
                        copy($sourceImage, $this->destinationPath . $this->sourceFilename);
                    }
                } else {
                    copy($sourceImage, $this->destinationPath . $this->sourceFilename);
                }
            }
        }

        return $this->sourceFilename;
        //rename($sourceImage, $this->destinationPath . $this->sourceFilename);
    }

    /**
     * Moving the file from one path to another path
     *
     * @param string $oldPath
     * @param string $newPath
     */
    public function moveFile($oldPath, $newPath)
    {
        if (file_exists($oldPath)) {
            rename($oldPath, $newPath);
        }
    }

    /**
     * Checking is the provided mime type is for image.
     *
     * @param string $mimeType
     * @return bool
     */
    public static function isItImage($mimeType)
    {
        $imageMimeTypes = array('image/jpeg', 'image/jpg', 'image/png', 'image/bmp', 'image/gif');

        return in_array(strtolower($mimeType), $imageMimeTypes);
    }

    public function newcropImage($width, $height, $thumbnail = false)
    {
        $sourceImage = $this->sourceFilepath . $this->sourceFilename;
        $widthHeight = $width . 'X' . $height;

        $widthAuto = $this->sourceFilepath . 'thumb_width_auto_' . $width . '_' . $this->sourceFilename;
        $thumb = $this->destinationPath . $this->sourceFilename;
        $command = '/usr/bin/convert ' . $sourceImage . ' -resize ' . $width . ' x ' . $widthAuto;
        if ($thumbnail) {
            $command = '/usr/bin/convert ' . $sourceImage . ' -resize x' . $height . ' ' . $widthAuto;
        }
        exec($command);

        $newImageSize = getimagesize($widthAuto);
        if ($newImageSize[0] >= $width) {
            $ratio = round(($newImageSize[0] - $width) / 2);
            // if width >= expected width and height is not maching.
            $command = '/usr/bin/convert ' . $widthAuto . ' -crop ' . $width . 'x' . $height . '+' . $ratio . ' ! -quality 100' . ' ' . $thumb;
            exec($command);
        } else if ($newImageSize[1] >= $height) {
            $ratio = round(($newImageSize[1] - $height) / 2);
            // if width >= expected width and height is not maching.
            $command = '/usr/bin/convert ' . $widthAuto . ' -shave 0x' . $ratio . ' -quality 100' . ' ' . $thumb;
            exec($command);
        } else {
            copy($widthAuto, $thumb);
        }

        unlink($widthAuto);

        //$fileNameDetails = explode(".",$this->sourceFilename);

        return $this->sourceFilename;
    }

}