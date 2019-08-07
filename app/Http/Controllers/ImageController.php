<?php
/**
 * Created by PhpStorm.
 * User: thai
 * Date: 10/7/2018
 * Time: 4:41 PM
 */

namespace App\Http\Controllers;


use App\Helpers\Business;
use App\Helpers\HttpCode;
use App\Helpers\MessageApi;
use App\Http\Controllers\Api\ApiController;
use App\Services\UploadImage;
use Illuminate\Http\Request;
use App\Rules\MaxSizeRule;

class ImageController extends ApiController
{
    /**
     * @var UploadImage
     */
    public $imageService;

    /**
     * ImageController constructor.
     * @param UploadImage $uploadImage
     */
    public function __construct(UploadImage $uploadImage)
    {
        $this->imageService = $uploadImage;
    }

    /**
     * @param Request $request
     * @return array|\Illuminate\Http\JsonResponse
     */
    public function store(Request $request)
    {
        $data = $this->validateData($request, $this->ruleImages());
        if (!is_array($data)) {
            return $data;
        }
        $image = $this->imageService->store($request);

        if (!$image) {
            return \response()->json(MessageApi::error([]), HttpCode::SUCCESS);
        }

        $dataResponse = [];
        foreach ($image as $id){
            array_push($dataResponse, [
                'full' => route('api.image.show', $id),
                'thumbnail' => route('api.image.show', ['id' => $id, 'type' => ($request->type) ? $request->type : Business::IMAGE_UPLOAD_TYPE_AVATAR]),
            ]);
        }

        return \response()->json(MessageApi::success($dataResponse), HttpCode::SUCCESS);
    }

    /**
     * @param $id
     * @param null $type
     * @return \Illuminate\Http\JsonResponse
     */
    public function show($id, $type=null)
    {
        $image = $this->imageService->show($id, $type);
        if ($image) {
            return response($image)->header('Content-type', 'image/png');
        }
        return \response()->json(MessageApi::error([MessageApi::ITEM_DOES_NOT_EXISTS]), HttpCode::FAILED);
    }

    /**
     * @param $id
     * @return \Illuminate\Http\JsonResponse
     */
    public function delete($id)
    {
        $image = $this->imageService->delete($id);
        if ($image){
            return \response()->json(MessageApi::success(['success']));
        }
        return \response()->json(MessageApi::error([]));
    }

    /**
     * @return array
     */
    private function ruleImages()
    {
        return [
            'file'        => [
                'required',
                //new MaxSizeRule(2048)
            ],
            'service_id' => 'required'
        ];
    }

    // Upload web
    public function storeWeb(Request $request)
    {
        $image = $this->imageService->store($request);
        if ($image){
            return redirect()->back()->with(
                [
                    'level' => 'success',
                    'flash_message' =>  __('label.success')
                ]
            );
        }
        return redirect()->back()->with(
            [
                'level' => 'danger',
                'flash_message' =>  __('label.failed')
            ]
        );
    }
}