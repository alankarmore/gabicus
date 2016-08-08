<?php

use App\Helpers\FileHelper;
use App\Services\CourseService;

class BaseController extends Controller
{

    protected $service;

    /**
     * Setup the layout used by the controller.
     *
     * @return void
     */
    protected function setupLayout()
    {
        if (!is_null($this->layout)) {
            $this->layout = View::make($this->layout);
        }
    }

    public function __construct()
    {
        $courseService = new CourseService();
        $courses = $courseService->getAllCourses();
        View::share(array('courses' => $courses));
    }

    public function uploadToTemp()
    {
        $fileInputName = Input::get('mediatype');
        $params = Input::file($fileInputName);
        $result = $this->validateMedia($fileInputName, $params);
        $response = array('valid' => 0, 'fileName' => null, 'error' => null);
        if ($result) {
            $response['error'] = $result;
        } else {
            $fileHelper = new FileHelper($params);
            $fileHelper->setFileName(time() . rand(1, 50));
            $isUpload = $fileHelper->upload('temp');
            if ($isUpload) {
                $response['valid'] = 1;
                $response['fileName'] = $fileHelper->getFileName();
            }
        }

        return json_encode($response);
    }

    /**
     * Removing temp file by given file name
     * 
     * @return json
     */
    public function removeTempImage()
    {
        $response = array('valid' => false);
        $fileName = Input::get('file');
        if (!empty($fileName)) {
            $response['valid'] = true;
        }

        return json_encode($response);
    }

    /**
     * Validating uploaded file.
     * 
     * @param string $fileType
     * @param Symfony\Component\HttpFoundation\File\UploadedFile $fileInput
     * @return mixed (string|bull)
     */
    public function validateMedia($fileType, $fileInput)
    {
        $mimeType = $fileInput->getMimeType();
        if ($fileType == 'image') {
            return (!FileHelper::isItImage($mimeType)) ? 'Upload Valid image' : false;
        }
    }

    /**
     * Get image content returned to the view 
     * 
     * @param string $folder
     * @param string $width
     * @param string $height
     * @param string $file
     */
    public function getImage($folder, $width, $height, $file)
    {
        $filePath = public_path('uploads/' . $folder . "/" . $file);
        $fileInfo = pathinfo($filePath);
        $cacheImageName = md5($width.$height.$fileInfo['filename']).".".$fileInfo['extension'];
        $cacheImagePath = public_path('uploads/imagecache/').$cacheImageName;
        if(!file_exists($cacheImagePath)) {
            if (file_exists($filePath)) {
                $fileHelper = new FileHelper();
                $fileHelper->sourceFilename = $file;
                $fileHelper->sourceFilepath = public_path('uploads/' . $folder . '/');
                $fileHelper->destinationPath = public_path('uploads/imagecache/');
                $fileName = $fileHelper->newcropImage($width, $height);
                $fileCachePath = public_path('uploads/imagecache/').$fileName;
                if(file_exists($fileCachePath)) {
                    $imageInfo = pathinfo($fileCachePath);
                    $cacheImageName = md5($width.$height.$imageInfo['filename']).".".$imageInfo['extension'];
                    $cacheImagePath = public_path('uploads/imagecache/').$cacheImageName;
                    rename($fileCachePath,$cacheImagePath);
                }
            } else {
                exit;
            }
        }
        
        $fp = fopen($cacheImagePath, 'rb');
        header("Content-Type: image/".$fileInfo['extension']);
        header("Content-Length: " . filesize($cacheImagePath));
        fpassthru($fp);
        exit;
        
    }

//    public function newcropImage($width, $height, $thumbnail = false)
//    {
//        $sourceImage = $this->sourceFilepath . $this->sourceFilename;
//        $widthHeight = $width . 'X' . $height;
//
//        $widthAuto = $this->sourceFilepath . 'thumb_width_auto_' . $width . '_' . $this->sourceFilename;
//        $thumb = $this->sourceFilepath . 'thumb_' . $widthHeight . '_' . $this->sourceFilename;
//        $command = '/usr/bin/convert ' . $sourceImage . ' -resize ' . $width . ' x ' . $widthAuto;
//        if ($thumbnail) {
//            $command = '/usr/bin/convert ' . $sourceImage . ' -resize x' . $height . ' ' . $widthAuto;
//        }
//        exec($command);
//
//        $newImageSize = getimagesize($widthAuto);
//        if ($newImageSize[0] >= $width) {
//            $ratio = round(($newImageSize[0] - $width) / 2);
//            // if width >= expected width and height is not maching.
//            $command = '/usr/bin/convert ' . $widthAuto . ' -crop ' . $width . 'x' . $height . '+' . $ratio . ' ! -quality 100' . ' ' . $thumb;
//            exec($command);
//        } else if ($newImageSize[1] >= $height) {
//            $ratio = round(($newImageSize[1] - $height) / 2);
//            // if width >= expected width and height is not maching.
//            $command = '/usr/bin/convert ' . $widthAuto . ' -shave 0x' . $ratio . ' -quality 100' . ' ' . $thumb;
//            exec($command);
//        } else {
//            copy($widthAuto, $thumb);
//        }
//
//        unlink($widthAuto);
//        
//        $fileNameDetails = explode(".",$this->sourceFilename);
//        
//        echo 'thumb_' . $widthHeight . '_' . $this->sourceFilename;
//    }

}
