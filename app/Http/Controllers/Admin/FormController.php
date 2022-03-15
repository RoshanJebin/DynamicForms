<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Field;
use App\Models\Form;
use Illuminate\Http\Request;
use Illuminate\Support\Str;

class FormController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        $forms = Form::orderBy('id', 'desc')->get();
        return view('admin.forms.index', compact('forms'));
    }
    public function create()
    {
        return view('admin.forms.create');
    }
    public function store(Request $request)
    {
        $validated = $request->validate([
            'title'       => 'required|max:255',
        ]);

        $slug = Str::slug($request->title);
        $data = [
            'title'          => $request->title,
            'slug'           => $slug
        ];
        $form = Form::create($data);

        if ($request->label) {
            foreach ($request->label as $key => $label) {

                $data = [
                    'form_id'         => $form->id,
                    'label'           => $label,
                    'html_field'      => $request->html_field[$key],
                    'custom_value'    => $request->custom_value[$key],
                ];

                Field::create($data);
            }
        }
        return redirect()->back()->with(['success' => 'Saved Successfully']);
    }

    public function edit($id)
    {
        $form  = Form::findorFail($id);
        return view('admin.forms.edit', compact('form'));
    }

    public function update(Request $request, $id)
    {
        $validated = $request->validate([
            'title'       => 'required|max:255',
        ]);

        $slug = Str::slug($request->title);
        $data = [
            'title'          => $request->title,
            'slug'           => $slug
        ];
        Form::findorFail($id)->update($data);
        if ($request->label) {
            foreach ($request->label as $key => $label) {

                $data = [
                    'form_id'         => $id,
                    'label'           => $label,
                    'html_field'      => $request->html_field[$key],
                    'custom_value'    => $request->custom_value[$key],
                ];

                Field::updateOrCreate(['id' => $request->field_id[$key], 'form_id' => $id], $data);
            }
        }
        return redirect()->back()->with(['success' => 'Saved Successfully']);
    }

    public function destroy($id)
    {
        Form::find($id)->delete();
        return redirect()->back()->with('success', 'Deleted Successfully');
    }
    public function delete_field($id)
    {
        Field::find($id)->delete();
        return redirect()->back();
    }
    public function activate($id)
    {
        $data['status'] = 1;
        Form::find($id)->update($data);
        return redirect()->back()->with('success', 'Activated Successfully');
    }

    public function deactivate($id)
    {
        $data['status'] = 0;
        Form::find($id)->update($data);
        return redirect()->back()->with('success', 'Deactivated Successfully');
    }
}
