<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 12/12/18
 * Time: 19:00
 */

namespace App\Http\Controllers\Admin;


use App\Helpers\Business;
use App\Http\Controllers\Controller;
use App\Models\Data\District;
use Illuminate\Http\Request;

class DistrictController extends Controller
{
    private $district;

    public function __construct(District $district)
    {
        $this->district = $district;
    }

    public function district($provinceId = null)
    {
        $title = __('label.district');
        $listResult = $this->district->where(['province_id' => $provinceId])->get();
        $listPublish = array(
            Business::PUBLISH => __('label.active'),
            Business::UN_PUBLISH => __('label.un_active'),
        );

        $listPublishColor = array(
            Business::PUBLISH => 'label-primary',
            Business::UN_PUBLISH => 'label-warning',
        );
        return view('admin.data.district.list', compact('listResult', 'title', 'listPublishColor', 'listPublish'));
    }

    public function action($id=null, Request $request)
    {
        $item = $this->district->find($id);
        if ($item){
            $publish = ($request->publish) ? $request->publish : 0;
            $item->publish = $publish;
            if ($item->save()){
                return redirect(route('district.index', $item->province_id))->with($this->messageResponse());
            }
        }
        return redirect()->back()->with($this->messageResponse('danger', __('label.failed')));
    }
    public function action2($id=null, Request $request)
    {
        $item = $this->district->find($id);
        if ($item){
            $publish_2 = ($request->publish_2) ? $request->publish_2 : 0;
            $item->publish_2 = $publish_2;
            if ($item->save()){
                return redirect(route('district.index', $item->province_id))->with($this->messageResponse());
            }
        }
        return redirect()->back()->with($this->messageResponse('danger', __('label.failed')));
    }
}