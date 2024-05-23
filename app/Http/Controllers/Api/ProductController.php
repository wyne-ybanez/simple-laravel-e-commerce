<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Http\Requests\ProductRequest;
use App\Http\Resources\ProductListResource;
use App\Http\Resources\ProductResource;
use Illuminate\Http\UploadedFile;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\URL;
use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $perPage = request('per_page', 10);
        $search = request('search', '');
        $sortField = request('sort_field', 'created_at');
        $sortDirection = request('sort_direction', 'desc');

        $query = Product::query()
            ->where('title', 'like', "%{$search}%")
            ->orderBy($sortField, $sortDirection)
            ->paginate($perPage);

        return ProductListResource::collection($query);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @return \Illuminate\Http\Response
     */
    public function store(ProductRequest $request)
    {
        $data = $request->validated();
        $data['created_by'] = $request->user()->id;
        $data['updated_by'] = $request->user()->id;

        /** @var \Illuminate\Http\UploadedFile $image */
        $image = $data['image'] ?? null;

        /** @var \Illuminate\Http\UploadedFile $image_1 */
        $image_1 = $data['image_1'] ?? null;

        /** @var \Illuminate\Http\UploadedFile $image_2 */
        $image_2 = $data['image_2'] ?? null;

        /** @var \Illuminate\Http\UploadedFile $image_3 */
        $image_3 = $data['image_3'] ?? null;

        // Check if image & images were given and save on local file system
        if ($image) {
            $relativePath = $this->saveImage($image);
            $data['image'] = URL::to(Storage::url($relativePath));
            $data['image_mime'] = $image->getClientMimeType();
            $data['image_size'] = $image->getSize();
        }
        if ($image_1) {
            $relativePath = $this->saveImage($image_1);
            $data['image_1'] = URL::to(Storage::url($relativePath));
            $data['image_mime_1'] = $image_1->getClientMimeType();
            $data['image_size_1'] = $image_1->getSize();
        }
        if ($image_2) {
            $relativePath = $this->saveImage($image_2);
            $data['image_2'] = URL::to(Storage::url($relativePath));
            $data['image_mime_2'] = $image_2->getClientMimeType();
            $data['image_size_2'] = $image_2->getSize();
        }
        if ($image_3) {
            $relativePath = $this->saveImage($image_3);
            $data['image_3'] = URL::to(Storage::url($relativePath));
            $data['image_mime_3'] = $image_3->getClientMimeType();
            $data['image_size_3'] = $image_3->getSize();
        }

        $product = Product::create($data);

        return new ProductResource($product);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function show(Product $product)
    {
        return new ProductResource($product);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function update(ProductRequest $request, Product $product)
    {
        $data = $request->validated();
        $data['updated_by'] = $request->user()->id;

        /** @var \Illuminate\Http\UploadedFile $image */
        $image = $data['image'] ?? null;

        /** @var \Illuminate\Http\UploadedFile $image_1 */
        $image_1 = $data['image_1'] ?? null;

        /** @var \Illuminate\Http\UploadedFile $image_2 */
        $image_2 = $data['image_2'] ?? null;

        /** @var \Illuminate\Http\UploadedFile $image_3 */
        $image_3 = $data['image_3'] ?? null;

        if ($image) {
            $relativePath = $this->saveImage($image);
            $data['image'] = URL::to(Storage::url($relativePath));
            $data['image_mime'] = $image->getClientMimeType();
            $data['image_size'] = $image->getSize();

            // if there is an existing image, delete it
            if ($product->image) {
                $imagePath = str_replace('storage/', '', parse_url($product->image, PHP_URL_PATH));
                Storage::deleteDirectory('/public/' . dirname($imagePath));
            }
        }
        if ($image_1) {
            $relativePath = $this->saveImage($image_1);
            $data['image_1'] = URL::to(Storage::url($relativePath));
            $data['image_mime_1'] = $image_1->getClientMimeType();
            $data['image_size_1'] = $image_1->getSize();

            if ($product->image_1) {
                $imagePath = str_replace('storage/', '', parse_url($product->image_1, PHP_URL_PATH));
                Storage::deleteDirectory('/public/' . dirname($imagePath));
            }
        }
        if ($image_2) {
            $relativePath = $this->saveImage($image_2);
            $data['image_2'] = URL::to(Storage::url($relativePath));
            $data['image_mime_2'] = $image_2->getClientMimeType();
            $data['image_size_2'] = $image_2->getSize();

            if ($product->image_2) {
                $imagePath = str_replace('storage/', '', parse_url($product->image_2, PHP_URL_PATH));
                Storage::deleteDirectory('/public/' . dirname($imagePath));
            }
        }
        if ($image_3) {
            $relativePath = $this->saveImage($image_3);
            $data['image_3'] = URL::to(Storage::url($relativePath));
            $data['image_mime_3'] = $image_3->getClientMimeType();
            $data['image_size_3'] = $image_3->getSize();

            if ($product->image_3) {
                $imagePath = str_replace('storage/', '', parse_url($product->image_3, PHP_URL_PATH));
                Storage::deleteDirectory('/public/' . dirname($imagePath));
            }
        }

        $product->update($data);

        return new ProductResource($product);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return \Illuminate\Http\Response
     */
    public function destroy(Product $product)
    {
        $product->delete();

        return response()->noContent();
    }

    /**
     * Save uploaded image file.
     *
     * @param  UploadedFile  $image
     * @return Path - image stored path
     */
    private function saveImage(UploadedFile $image)
    {
        $path = 'images/' . Str::random();

        if (!Storage::exists($path)) {
            Storage::makeDirectory($path, 0755, true);
        }

        if (!Storage::putFileAS('public/' . $path, $image, $image->getClientOriginalName())) {
            throw new \Exception("Unable to save file \"{$image->getClientOriginalName()}\"");
        }

        return $path . '/' . $image->getClientOriginalName();
    }
}
