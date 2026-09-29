<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\Package;
use Illuminate\Http\Request;

class PackageController extends Controller
{
    public $route = 'admin.package';

    // List all packages
    public function index()
    {
        $packages = Package::latest()->get();
        return view('admin.pages.package.index', compact('packages'));
    }

    // Show create/edit form
    public function create($id = null)
    {
        $data = $id ? Package::findOrFail($id) : null;
        return view('admin.pages.package.insert', compact('data'));
    }

    // Show a specific package
    public function view($id)
    {
        $data = Package::findOrFail($id);
        return view('admin.pages.package.view', compact('data'));
    }

    // Insert or update package
    public function insert_or_update(Request $request)
    {
        $request->validate([
            'name'                        => 'required|string|max:255',
            'title'                       => 'required|string|max:255',
            'price'                       => 'required|numeric',
            'validity'                    => 'required|numeric',
            'commission_with_avg_amount' => 'required|numeric',
            'max_purchase_limit'         => 'required|integer|min:1',
            'min_purchase_limit'         => 'required|integer|min:1',
            'vip_level'                  => 'required|integer|min:1|max:10',
            'category'                   => 'required|in:fixed,welfare,activity',
            'photo'                      => $request->id ? 'nullable|image' : 'required|image',
        ]);

        $model = $request->id ? Package::findOrFail($request->id) : new Package();

        // Handle image upload
        if ($request->hasFile('photo')) {
            if ($model->photo) {
                deleteImage($model->photo);
            }
            $model->photo = uploadImage(false, $request, 'photo', 'upload/package/', 400, 400);
        }

        // Assign fields
        $model->name                         = $request->name;
        $model->title                        = $request->title;
        $model->price                        = $request->price;
        $model->validity                     = $request->validity;
        $model->commission_with_avg_amount   = $request->commission_with_avg_amount;
        $model->max_purchase_limit           = $request->max_purchase_limit;
        $model->min_purchase_limit           = $request->min_purchase_limit;
        $model->vip_level                    = $request->vip_level;
        $model->category                     = $request->category;
        $model->desc                         = $request->desc;

        // Use string '1' or '0' for ENUM fields
        $model->status       = $request->status ?? 'active';
        $model->is_default   = $request->has('is_default') ? '1' : '0';
        $model->is_sold_out  = $request->has('is_sold_out') ? '1' : '0';
        $model->is_resale    = $request->has('is_resale') ? '1' : '0';

        $model->save();

        return redirect()->route($this->route . '.index')->with(
            'success',
            $request->id ? 'Package updated successfully!' : 'Package created successfully!'
        );
    }

    // Delete a package
    public function delete($id)
    {
        $model = Package::findOrFail($id);

        if ($model->photo) {
            deleteImage($model->photo);
        }

        $model->delete();

        return redirect()->route($this->route . '.index')->with('success', 'Package deleted successfully!');
    }
}
