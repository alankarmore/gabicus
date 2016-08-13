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

        if(!Cache::has('courses')) {
            $categoryCourses = $courseService->getCoursesAccordingToCategory();
        } else {
            $categoryCourses = Cache::get('courses');
        }

        View::share(array('courses' => $courses,'categoryCourses' => $categoryCourses));
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
                if (extension_loaded('imagick')) {
                    if (file_exists($filePath)) {
                        $fileHelper = new FileHelper();
                        $fileHelper->sourceFilename = $file;
                        $fileHelper->sourceFilepath = public_path('uploads/' . $folder . '/');
                        $fileHelper->destinationPath = public_path('uploads/imagecache/');
                        ;
                        $fileName = $fileHelper->resizeImage('course');
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
                } else {
                    //get image size
                    if(file_exists($filePath)) {
                        copy($filePath,public_path('uploads/imagecache/').$file);
                    }
                    $filePath = public_path('uploads/imagecache/').$file;
                    //Get the original image dimensions + type
                    list($source_width, $source_height, $source_type) = getimagesize($filePath);

                    //Figure out if we need to create a new JPG, PNG or GIF
                    $ext = strtolower($fileInfo['extension']);
                    if ($ext == "jpg" || $ext == "jpeg") {
                        $source_gdim=imagecreatefromjpeg($filePath);
                    } elseif ($ext == "png") {
                        $source_gdim=imagecreatefrompng($filePath);
                    } elseif ($ext == "gif") {
                        $source_gdim=imagecreatefromgif($filePath);
                    } else {
                        //Invalid file type? Return.
                        return;
                    }

                    //If a width is supplied, but height is false, then we need to resize by width instead of cropping
                    if ($width && !$height) {
                        $ratio = $width / $source_width;
                        $temp_width = $width;
                        $temp_height = $source_height * $ratio;

                        $desired_gdim = imagecreatetruecolor($temp_width, $temp_height);
                        imagecopyresampled(
                            $desired_gdim,
                            $source_gdim,
                            0, 0,
                            0, 0,
                            $temp_width, $temp_height,
                            $source_width, $source_height
                        );
                    } else {
                        $source_aspect_ratio = $source_width / $source_height;
                        $desired_aspect_ratio = $width / $height;

                        if ($source_aspect_ratio > $desired_aspect_ratio) {
                            /*
                             * Triggered when source image is wider
                             */
                            $temp_height = $height;
                            $temp_width = ( int ) ($height * $source_aspect_ratio);
                        } else {
                            /*
                             * Triggered otherwise (i.e. source image is similar or taller)
                             */
                            $temp_width = $width;
                            $temp_height = ( int ) ($width / $source_aspect_ratio);
                        }

                        /*
                         * Resize the image into a temporary GD image
                         */

                        $temp_gdim = imagecreatetruecolor($temp_width, $temp_height);
                        imagecopyresampled(
                            $temp_gdim,
                            $source_gdim,
                            0, 0,
                            0, 0,
                            $temp_width, $temp_height,
                            $source_width, $source_height
                        );

                        /*
                         * Copy cropped region from temporary image into the desired GD image
                         */

                        $x0 = ($temp_width - $width) / 2;
                        $y0 = ($temp_height - $height) / 2;
                        $desired_gdim = imagecreatetruecolor($width, $height);
                        imagecopy(
                            $desired_gdim,
                            $temp_gdim,
                            0, 0,
                            $x0, $y0,
                            $width, $height
                        );
                    }

                    /*
                     * Render the image
                     * Alternatively, you can save the image in file-system or database
                     */

                    $cacheImageName = md5($width.$height.$fileInfo['filename']).".".$fileInfo['extension'];
                    $destination = public_path('uploads/imagecache/').$cacheImageName;
                    if ($ext == "jpg" || $ext == "jpeg") {
                        ImageJpeg($desired_gdim,$destination,100);
                    } elseif ($ext == "png") {
                        ImagePng($desired_gdim,$destination);
                    } elseif ($ext == "gif") {
                        ImageGif($desired_gdim,$destination);
                    } else {
                        return;
                    }

                    ImageDestroy ($desired_gdim);
                }
        }

        $fp = fopen($cacheImagePath, 'rb');
        header("Content-Type: image/".$fileInfo['extension']);
        header("Content-Length: " . filesize($cacheImagePath));
        fpassthru($fp);
        exit;
        
    }

}
