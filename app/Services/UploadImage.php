<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 10/7/2018
 * Time: 4:08 PM
 */

namespace App\Services;


use App\Helpers\Business;
use App\Models\Image;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Image as Upload;

class UploadImage
{
    /**
     * @var Image
     */
    public $model;

    /**
     * UploadImage constructor.
     * @param Image $image
     */
    public function __construct(Image $image)
    {
        $this->model = $image;
    }

    /**
     * @param Request $request
     * @return array | bool
     */
    public function store(Request $request)
    {
        $path = $this->setPath();
        if (!file_exists($path)) {
            mkdir($path, 0777, true);
        }

        if ($request->hasFile('file')) {
            $files = $request->file('file');
            logger($files);
            $listID = [];
            if (is_array($files)){
                foreach ($files as $file){
                    $fileName = $file->getClientOriginalName();
                    $folderPath = $path . '/';
                    $file->move($folderPath, $fileName);

                    // Resize
                    $this->createImage($folderPath, $fileName, $request->type);
                    $data = [
                        'path'         => $path . '/',
                        'filename'         => $fileName,
                        'position' => $request->position,
                        'type' => ($request->type) ? $request->type : Business::IMAGE_UPLOAD_TYPE_AVATAR,
                        'service_id' => $request->service_id
                    ];
                    $image = $this->model->create($data)->id;
                    array_push($listID, $image);
                }
            }else{
                $fileName = $files->getClientOriginalName();
                $folderPath = $path . '/';
                $files->move($folderPath, $fileName);
                // avatar remove
                if (!$request->type){
                    $image = $this->model->where(['type' => Business::IMAGE_UPLOAD_TYPE_AVATAR, 'service_id' => $request->service_id])->first();
                    if ($image){
                        $this->delete($image->id);
                    }
                }
                // Resize
                $this->createImage($folderPath, $fileName, $request->type);
                $data = [
                    'path'         => $path . '/',
                    'filename'         => $fileName,
                    'position' => $request->position,
                    'type' => ($request->type) ? $request->type : Business::IMAGE_UPLOAD_TYPE_AVATAR,
                    'service_id' => $request->service_id
                ];
                $image = $this->model->create($data)->id;
                array_push($listID, $image);
            }
            return $listID;
        }

        return false;
    }

    /**
     * @param $folderPath
     * @param $fileName
     * @param string $type
     */
    private function createImage($folderPath, $fileName, $type=Business::IMAGE_UPLOAD_TYPE_AVATAR)
    {
        if (!$type){
            $type = Business::IMAGE_UPLOAD_TYPE_AVATAR;
        }
        $imageWidth = config('image.avatar_width');
        $imageHeight = config('image.avatar_height');

        if(strtoupper($type) == strtoupper(Business::IMAGE_UPLOAD_TYPE_ORDER)){
            $imageWidth = config('image.order_width');
            $imageHeight = config('image.order_height');
        }

        //Resize image
        $folderPathImage = $folderPath . strtoupper($type);
        if (!file_exists($folderPathImage)) {
            mkdir($folderPathImage, 0777, true);
        }

        $img = Upload::make($folderPath . $fileName);
        $img->resize($imageWidth, $imageHeight, function ($constraint) {
            $constraint->aspectRatio();
        })->save($folderPathImage . '/' . $fileName);
    }

    /**
     * @param $id
     * @param $type
     * @return bool|string
     */
    public function show($id, $type)
    {
        $folder = ($type && in_array($type, config('image.image_folder'))) ? strtoupper($type) : false;
        $image = $this->model->find($id);
        if ($image) {
            $link = ($folder) ? $image->path . $folder . '/' . $image->filename : $image->path . $image->filename;
            try{
                $img = file_get_contents($link);
                return $img;
            }catch (\Exception $exception){
                logger($exception->getMessage());
            }
        }
        return false;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $image = $this->model->find($id);
        if ($image){
            $imageFull = $image->path . $image->filename;
            $imageThumb = $image->path . $image->type . '/' . $image->filename;
            if (file_exists($imageFull)){
                unlink( $imageFull);
            }
            if (file_exists($imageThumb)){
                unlink( $imageThumb);
            }
            $image->delete();
            return true;
        }
        return false;
    }

    /**
     * @return string
     */
    private function setPath()
    {
        return public_path('storage/uploads/' . Carbon::now()->format('dmY'));
    }
}