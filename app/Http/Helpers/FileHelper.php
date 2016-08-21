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
     * Cropping image according to the given width and height
     *
     * @param integer $width
     * @param integer $height
     * @param null|string $key
     * @return string
     */
    private function _cropImage($width,$height, $key = null)
    {
        $sourceImage = $this->sourceFilepath . $this->sourceFilename;
        $widthHeight = $width . 'X' . $height;

        $widthAuto = $this->sourceFilepath . 'thumb_width_auto_' . $width . '_' . $this->sourceFilename;
        $thumb = $this->destinationPath . $this->sourceFilename;
        $command = '/usr/bin/convert ' . $sourceImage . ' -resize ' . $width . ' x ' . $widthAuto;
        if ($key == 'small') {
            $command = '/usr/bin/convert ' . $sourceImage . ' -resize x' . $height . ' ' . $widthAuto;
        }
        exec($command);

        $newImageSize = getimagesize($widthAuto);

        if ($key == 'small') {
            if ($newImageSize[0] >= $width) {
                $ratio = round(($newImageSize[0] - $width) / 2);
                // if width >= expected width and height is not maching.
                $command = '/usr/bin/convert ' . $widthAuto . ' -crop ' . $width . 'x' . $height . '+' . $ratio . ' ! -quality 100' . ' ' . $thumb;
                exec($command);
            } else {
                copy($widthAuto, $thumb);
            }
        } else {
            if ($newImageSize[1] >= $height) {
                $ratio = round(($newImageSize[1] - $height) / 2);
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
     * @param integer $width
     * @param integer $height
     * @param boolean $checkDir
     * @return string
     */
    public function resizeImage($width,$height,$checkDir = false)
    {
        $sourceImage = $this->sourceFilepath . $this->sourceFilename;
        if ($checkDir) {
            if (!file_exists($this->destinationPath)) {
                mkdir($this->destinationPath, 0777, TRUE);
                chmod($this->destinationPath, 0777);
            }
        }

        $originalImageSize = getimagesize($sourceImage);
        if ($originalImageSize[0] >= $width || $originalImageSize[1] >= $height) {
            $thumbnail = $this->_cropImage($width,$height);
            if (!empty($thumbnail)) {
                return $thumbnail;
            } else {
                copy($sourceImage, $this->destinationPath . $this->sourceFilename);
            }
        } else {
            copy($sourceImage, $this->destinationPath . $this->sourceFilename);
        }

        /*foreach ($this->$entityName as $key => $dimension) {
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
        }*/

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