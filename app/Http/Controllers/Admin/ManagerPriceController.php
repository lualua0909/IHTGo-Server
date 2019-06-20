<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 8/10/18
 * Time: 22:54
 */

namespace App\Http\Controllers\Admin;

use App\Helpers\Business;
use App\Http\Controllers\Controller;
use App\Http\Requests\ManagerPriceRequest;
use App\Models\Data\Other;
use App\Models\Data\Province;
use App\Models\ManagerPrice;

class ManagerPriceController extends Controller
{
    public $model;

    public function __construct(ManagerPrice $model)
    {
        $this->model = $model;
    }

    /**
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function getList()
    {
        $title = __('label.management_price');
        $listPublish = array(
            Business::PUBLISH => __('label.active'),
            Business::UN_PUBLISH => __('label.un_active'),
        );

        $listPublishColor = array(
            Business::PUBLISH => 'label-primary',
            Business::UN_PUBLISH => 'label-warning',
        );

//        $listOption = [
        //            Business::SETTING_MONEY_BY_KM => __('label.km'),
        //            Business::SETTING_MONEY_BY_WEIGHT => __('label.weight')
        //        ];
        //
        //        $listOptionColor = [
        //            Business::SETTING_MONEY_BY_KM => 'label-primary',
        //            Business::SETTING_MONEY_BY_WEIGHT => 'label-warning'
        //        ];

        $listType = [
            Business::PRICE_BY_TH1 => __('label.th1'),
            Business::PRICE_BY_TH2 => __('label.th2'),
            Business::PRICE_BY_TH3 => __('label.th3'),
        ];

        $listTypeColor = [
            Business::PRICE_BY_TH1 => 'label-primary',
            Business::PRICE_BY_TH2 => 'label-danger',
            Business::PRICE_BY_TH3 => 'label-success',
        ];

//        $listTypeCar = [
        //            Business::CAR_TYPE_MOTORBIKE => __('label.motorbike'),
        //            Business::CAR_TYPE_TRUCK => __('label.truck'),
        //        ];

        $listTypeCar = Other::select('id', 'name')->where(['type' => Business::OTHER_TYPE_CAR])->get()->pluck('name', 'id')->toArray();

//        $listTypeCarColor = [
        //            Business::CAR_TYPE_MOTORBIKE => 'label-primary',
        //            Business::CAR_TYPE_TRUCK => 'label-danger',
        //        ];

        $listResult = $this->model->all();
        return view('admin.price.list', compact(
            'listResult',
            'title',
            'listType',
            'listTypeColor',
            // 'listOption',
            // 'listOptionColor',
            'listPublish',
            'listPublishColor',
            'listTypeCar'
        ));
    }

    public function create($type)
    {
//        $listOption = [
        //            Business::SETTING_MONEY_BY_KM => __('label.km'),
        //            Business::SETTING_MONEY_BY_WEIGHT => __('label.weight')
        //        ];
        //        $listType = [
        //            Business::PRICE_BY_TH1 => __('label.th1'),
        //            Business::PRICE_BY_TH2 => __('label.th2'),
        //            Business::PRICE_BY_TH3 => __('label.th3'),
        //        ];
        $view = $this->getFormCreate($type);

        $listProvince = Province::where(['publish' => Business::PUBLISH])->get();

        //$listDistrict = ($type != Business::PRICE_BY_TH1) ? District::where(['publish' => 1, 'province_id' => 74])->get() : false;

        $listTypeCar = Other::select('id', 'name')->where(['type' => Business::OTHER_TYPE_CAR])->get()->pluck('name', 'id')->toArray();
        $title = __('label.manager_price_create');
        $item = false;
        return view('admin.price.' . $view, compact('item', 'title', 'listTypeCar', 'type', 'listProvince'));
    }

    public function store($type, ManagerPriceRequest $request)
    {
        $dataStore = $request->only('min', 'increase', 'type_car', 'note', 'time_receive', 'time_sende', 'to',
            'address_payment', 'address_receive', 'from');
        $dataStore['option'] = Business::SETTING_MONEY_BY_WEIGHT;
        $dataStore['type'] = $type;
//        if ($request->from && $request->to && $request->value){
        //            $advance = [];
        //            for($i = 0; $i < count($request->value); $i++){
        //                array_push($advance, [
        //                    'from' => $request->from[$i],
        //                    'to' => $request->to[$i],
        //                    'value' => str_replace(',', '', $request->value[$i])
        //                ]);
        //            }
        //            $dataStore['advance'] = $advance;
        //        }
        $dataStore['min_value'] = str_replace(',', '', $request->min_value);
        $dataStore['increase_value'] = str_replace(',', '', $request->increase_value);
        $dataStore['publish'] = Business::PUBLISH;
        $dataStore['user_id'] = $request->user()->id;

        if ($this->model->create($dataStore)) {
            return redirect(route('price.list'))->with($this->messageResponse());
        }
        return redirect(route('price.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    public function detail($id)
    {
        $item = $this->model->find($id);
        if ($item) {
            $title = __('label.detail');
            $listPublish = array(
                Business::PUBLISH => __('label.active'),
                Business::UN_PUBLISH => __('label.un_active'),
            );

            $listPublishColor = array(
                Business::PUBLISH => 'label-primary',
                Business::UN_PUBLISH => 'label-warning',
            );

            $listOption = [
                Business::SETTING_MONEY_BY_KM => __('label.km'),
                Business::SETTING_MONEY_BY_WEIGHT => __('label.weight'),
            ];

            $listOptionColor = [
                Business::SETTING_MONEY_BY_KM => 'label-primary',
                Business::SETTING_MONEY_BY_WEIGHT => 'label-warning',
            ];

            $listType = [
                Business::PRICE_BY_TH1 => __('label.th1'),
                Business::PRICE_BY_TH2 => __('label.th2'),
                Business::PRICE_BY_TH3 => __('label.th3'),
            ];

            $listTypeColor = [
                Business::PRICE_BY_TH1 => 'label-primary',
                Business::PRICE_BY_TH2 => 'label-danger',
                Business::PRICE_BY_TH3 => 'label-success',
            ];

            $listTypeCar = Other::select('id', 'name')->where(['type' => Business::OTHER_TYPE_CAR])->get()->pluck('name', 'id')->toArray();
            return view('admin.price.detail', compact(
                'item',
                'listTypeCar',
                'listType',
                'listTypeColor',
                'listOption',
                'listOptionColor',
                'listPublish',
                'listPublishColor',
                'title'
            ));
        }
        return abort(404);
    }

    public function show()
    {
        $listResult = $this->model->where(['publish' => Business::PUBLISH])->get();
        if ($listResult) {
            $listOption = [
                Business::SETTING_MONEY_BY_KM => __('label.km'),
                Business::SETTING_MONEY_BY_WEIGHT => __('label.weight'),
            ];

            $listType = [
                Business::PRICE_BY_TH1 => __('label.th1'),
                Business::PRICE_BY_TH2 => __('label.th2'),
                Business::PRICE_BY_TH3 => __('label.th3'),
            ];

            $listTypeCar = Other::select('id', 'name')->where(['type' => Business::OTHER_TYPE_CAR])->get()->pluck('name', 'id')->toArray();
            return view('admin.price.show2', compact('listType', 'listTypeCar', 'listResult', 'listOption'));
        }
    }

    public function delete($id)
    {
        if ($this->model->where(['id' => $id])->update(['publish' => Business::UN_PUBLISH])) {
            return redirect(route('price.list'))->with($this->messageResponse());
        }
        return redirect(route('price.list'))->with($this->messageResponse('danger', __('label.failed')));
    }

    public function security()
    {
        return view('admin.price.security');
    }

    private function getFormCreate($type)
    {
        switch ($type) {
            case Business::PRICE_BY_TH1:
                return 'provincial';
                break;
            case Business::PRICE_BY_TH2:
                return 'race';
                break;
            case Business::PRICE_BY_TH3:
                return 'out_province';
                break;
        }
    }
}
