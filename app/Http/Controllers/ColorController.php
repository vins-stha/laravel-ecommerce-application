<?php

namespace App\Http\Controllers;

use App\Color;
use Illuminate\Http\Request;

class ColorController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $this->colors = Color::all();

        return view('color.colors',['colors' => $this->colors]);
    }

    public function  addColor(Request $request)
    {
        if($request->getMethod() == "POST")
        {
            if(isset($request['color_name']) && !empty($request['color_name']))
            {
                $request->validate([
                    'color_name' =>'required',
                    'code' => 'unique:colors'
                ]);
                $this->color = new Color();
                $this->color->name = $request['color_name'];
                $this->color->code = $request['color_code'] == '' ? '':$request['color_code'];

                if ($this->color->save())
                {
                    $request->session()->flash('message', 'New Color successfully added');
                    return redirect('admin/colors');
                }
                else
                {
                    $request->session()->flash('error', 'Something went wrong');
                    return redirect('admin/colors');
                }
            }
        }
        else
        {
            return view('color.addColor');
        }
    }

    public function  editColor(Request $request,$id='')
    {
        if($request->getMethod() == "POST")
        { var_dump($request->post());
            if(isset($request['color_name']) && !empty($request['color_name']))
            {
                $request->validate([
                    'color_name' =>'required',
                    'code' => 'unique:colors'
                ]);
                $this->color = Color::find($request['color_id']);
                $this->color->name = $request['color_name'];
                $this->color->code = $request['color_code'] == '' ? '':$request['color_code'];

                if ($this->color->save())
                {
                    $request->session()->flash('message', ' Color successfully updated');
                    return redirect('admin/colors');
                }
                else
                {
                    $request->session()->flash('error', 'Something went wrong');
                    return redirect('admin/colors');
                }
            }
        }
        else
        {
            $this->color = Color::find($id);
            if( $this->color != null)
            {
                return view('color.editColor',['color' => $this->color]);
            }
            else
            {
                $request->session()->flash('error', 'Item not found ');
                return redirect('admin/colors');
            }

        }
    }

    public function deleteColor(Request $request, $id)
    {
        $this->color = Color::find($id);
        if (!empty($this->color)) {
            $this->color->delete();
            $request->session()->flash('message', 'Color deleted successfully');
        } else {
            $request->session()->flash('error', 'Color does not exist');
        }

        return redirect('admin/colors');
    }
}
