<?php

namespace App\Http\Services;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\Country;
use App\Models\Provider;
use App\Models\Genre;
use Illuminate\Support\Facades\DB;
use Intervention\Image\Facades\Image;

class ProductsService
{
    public function getAll(Request $request){
        $queryProducts = Product::with(['country','provider','genres']);

        $q = $request->has('q') ? $request->query('q') : null;
        if($q)
            $queryProducts->where('detail', 'like', '%'.$q.'%');

        return $queryProducts->get();
    }

    public function getPaginated(Request $request){
        $queryProducts = Product::with(['country','provider','genres']);
        $q = $request->has('q') ? $request->query('q') : null;
        if($q)
            $queryProducts->where('detail', 'like', '%'.$q.'%');

        return $queryProducts->paginate(8)->withQueryString();
    }

    public function formCreate(){
        $countrys = Country::all();
        $providers = Provider::all();
        $genres = Genre::all();
        return view('admin/products/new',[
            'countrys'=>$countrys,
            'providers'=>$providers,
            'genres'=>$genres,
        ]);
    }

    public function createProduct(Request $request){

        $request->validate(Product::$rules, Product::$rulesMessage);
        $data = $request->all();
        $data['image'] = $this->uploadImage($request);

        try{
           DB::transaction(function () use ($data) {
                $product = Product::create($data);

                $product->genres()->attach($data['id_genre'] ?? []);
            });
        }catch(Exception $e){
            return $this->toRoute('create.form.product',[
                'error' => 'El producto no se pudo crear por un error en la base de datos.'
            ])->withInput();
        }
        return $this->toRoute('admin.products.index')->with('message.success','El producto <b>'.e($data['detail']).'</b> se agrego con exito.');;
    }

    public function getById($id){
        return Product::findOrFail($id);
    }

    public function formEdit(int $id){
        $countrys = Country::all();
        $providers = Provider::all();
        $product = Product::findOrFail($id);
        $genres = Genre::all();

        return view('admin/products/edit', [
            'product'=> $product,
            'countrys'=> $countrys,
            'providers'=> $providers,
            'genres'=> $genres,
        ]);
    }

    public function editProduct(Request $request, int $id){
        $product = Product::findOrFail($id);

        $request->validate(Product::$rules, Product::$rulesMessage);

        $data = $request->all();
        // Obtener imagen enviada mediante formulario como archivo adjunto
        // if($request->hasFile('image'))
        //     $data['image'] = $this->uploadImage($request);

        $data['image'] = $this->uploadImage($request) ?? $product->image;

        try{
             DB::transaction(function () use ($product, $data) {
                $product->update($data);

                $product->genres()->sync($data['id_genre'] ?? []);
            });
        }catch(Exception $e){
            return $this->toRoute('create.form.product',[
                'error' => 'El producto no se pudo crear por un error en la base de datos.'
            ])->withInput();
        }

         return $this->toRoute('admin.products.index')->with('message.success','El producto <b>'.e($product->detail).'</b> fue editado exitosamente.');
    }


    public function delete(int $id){
        $product = Product::findOrFail($id);
        try{
            DB::transaction(function () use ($product) {
                $product->genres()->detach();
                $product->delete();
            });
        }catch(Exception $e){
            return $this->toRoute('products.index',[
                'error' => 'El producto no se pudo eliminar por un error en la base de datos.'
            ])->withInput();
        }

        return $this->toRoute('admin.products.index')->with('message.success','El producto <b>'.e($product->detail).'</b> fue eliminado exitosamente.');    }


    protected function uploadImage(Request $request, string $field='image') : string|null {
        if($request->hasFile($field) && $request->file($field)->isValid()){

            $filename = date('YmdHis_').".".$request->file($field)->extension();

            Image::make($request->file($field))
                ->resize(500,500, function($constraint) {
                    $constraint->aspectRatio();
                    $constraint->upsize();
                })->save(public_path('images/'.$filename));

            return $filename;
        }
        return null;
    }

    protected function toRoute(string $route, array $messages = []){
        $redirect = redirect()->route($route);
        foreach($messages as $type => $message){
            $redirect->with('message.'.$type, $message);
        }
        return $redirect;
    }
}
