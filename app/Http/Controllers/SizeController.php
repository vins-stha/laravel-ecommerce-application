<?php

namespace App\Http\Controllers;


use App\Size;
use Illuminate\Http\Request;

class SizeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->sizes = Size::all();

        return view('size.sizes',['sizes' => $this->sizes]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function  addSize(Request $request)
    {
        if($request->getMethod() == "POST")
        {
            if(isset($request['size_name']) && !empty($request['size_name']))
            {
                $request->validate([
                    'size_name' =>'required',
                    'code' => 'unique:sizes'
                ]);
                $this->size = new Size();
                $this->size->name = $request['size_name'];
                $this->size->code = $request['size_code'] == '' ? '':$request['size_code'];

                if ($this->size->save())
                {
                    $request->session()->flash('message', 'New size successfully added');
                    return redirect('admin/sizes');
                }
                else
                {
                    $request->session()->flash('error', 'Something went wrong');
                    return redirect('admin/sizes');
                }
            }
        }
        else
        {
            return view('size.addSize');
        }
    }

    public function  editSize(Request $request,$id='')
    {
        if($request->getMethod() == "POST")
        { var_dump($request->post());
            if(isset($request['size_name']) && !empty($request['size_name']))
            {
                $request->validate([
                    'size_name' =>'required',
                    'code' => 'unique:sizes'
                ]);
                $this->size = Size::find($request['size_id']);
                $this->size->name = $request['size_name'];
                $this->size->code = $request['size_code'] == '' ? '':$request['size_code'];

                if ($this->size->save())
                {
                    $request->session()->flash('message', ' size successfully updated');
                    return redirect('admin/sizes');
                }
                else
                {
                    $request->session()->flash('error', 'Something went wrong');
                    return redirect('admin/sizes');
                }
            }
        }
        else
        {
            $this->size = Size::find($id);
            if( $this->size != null)
            {
                return view('size.editSize',['size' => $this->size]);
            }
            else
            {
                $request->session()->flash('error', 'Item not found ');
                return redirect('admin/sizes');
            }

        }
    }

    public function deleteSize(Request $request, $id)
    {
        $this->size = Size::find($id);
        if (!empty($this->size)) {
            $this->size->delete();
            $request->session()->flash('message', 'size deleted successfully');
        } else {
            $request->session()->flash('error', 'size does not exist');
        }

        return redirect('admin/sizes');
    }

}
