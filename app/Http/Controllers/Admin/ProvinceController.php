<?php
/**
 * Created by PhpStorm.
 * User: hcenter
 * Date: 12/12/18
 * Time: 17:31
 */

namespace App\Http\Controllers\Admin;


use App\Helpers\Business;
use App\Http\Controllers\Controller;
use App\Models\Data\Province;
use Illuminate\Http\Request;

class ProvinceController extends Controller
{
    private $province;

    public function __construct(Province $province)
    {
        $this->province = $province;
    }

    public function index()
    {
        $title = __('label.province');
        $listResult = $this->province->all();
        $listPublish = array(
            Business::PUBLISH => __('label.active'),
            Business::UN_PUBLISH => __('label.un_active'),
        );

        $listPublishColor = array(
            Business::PUBLISH => 'label-primary',
            Business::UN_PUBLISH => 'label-warning',
        );
        return view('admin.data.province.list', compact('listResult', 'title', 'listPublish', 'listPublishColor'));
    }

    public function action($id=null, Request $request)
    {
        $item = $this->province->where(['province_id' => $id])->first();
        if ($item){
            $data = [
                'publish' => ($request->publish) ? $request->publish : 0
            ];
            if ($this->province->where(['province_id' => $id])->update($data)){
                return redirect(route('province.index'))->with($this->messageResponse());
            }
        }
        return redirect()->back()->with($this->messageResponse('danger', __('label.failed')));
    }
}