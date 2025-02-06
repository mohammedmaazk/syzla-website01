<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Brand;
use App\Rules\FileTypeValidate;
use Illuminate\Http\Request;

class BrandController extends Controller
{

	public function index()
	{
		$pageTitle = "Manage Brands";
		$brands    = Brand::searchable(['name'])->paginate(getPaginate());
		return view('admin.brand', compact('pageTitle', 'brands'));
	}

	public function store(Request $request, $id = 0)
	{

		$isRequired = $id ? 'nullable' : 'required';

		$request->validate([
			'name'  => 'required|unique:brands,name,' . $id,
			'image' => [$isRequired, 'image', new FileTypeValidate(['jpg', 'jpeg', 'png'])],
		]);

		if ($id) {
			$brand   = Brand::findOrFail($id);
			$message = "Brand updated successfully";
		} else {
			$brand   = new Brand();
			$message = "Brand added successfully";
		}

		if ($request->hasFile('image')) {
			try {
				$brand->image = fileUploader($request->image, getFilePath('brand'), getFileSize('brand'), @$brand->image);
			} catch (\Exception $exp) {
				$notify[] = ['error', 'Couldn\'t upload your image'];
				return back()->withNotify($notify);
			}
		}

		$brand->name = $request->name;
		$brand->save();

		$notify[] = ["success", $message];
		return back()->withNotify($notify);
	}

	public function status($id)
	{
		return Brand::changeStatus($id);
	}

	public function featured($id)
	{
        return Brand::changeStatus($id, 'featured');
	}
}
