<?php // para criar um arquivo controller: php artisan make:controller NomeController

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User; // importanto a classe User
use App\Product; // importando a classe Product
use Auth; // importando a classe Auth. Ou Auth()->user()->id se não importar.

class ProductController extends Controller
{
    public function create(Request $request) { // parâmetro/objeto $request dentro da classe Request. Esse parâmetro é nomeado por mim, ele pega todas as informações get ou post.

        // OPÇÃO de criação de produto: if get ou if post
        // if($request->isMethod('GET')){ 
        //     return view('formulario');
        // } else {
        //     criar o produto
        // }

        // criando objeto
        $newProduct = new Product();  
        $newProduct->name = $request->nameProduct; // name da tabela Products é igual ao nameProduct dor for enviado via request (pega cada name e transforma em atributo) 
        $newProduct->description = $request->descriptionProduct; // o primeiro é da tabela e o segundo é do formulário
        $newProduct->quantity = $request->quantityProduct; 
        $newProduct->price = $request->priceProduct;
        $newProduct->user_id = Auth::user()->id; // classe global com método user que retorna as informações do usuário logado no momento.
        
        $result = $newProduct->save(); // salvando objeto. Traz um boleano. Não precisa fazer a query, já é automático do Laravel, só precisa criar o objeto.

        // OPÇÃO de validação
        // if($result){
        //     echo "Deu certo sem query!";
        // } else {
        //     echo "Vai ter que criar uma!";
        // }

        return view('products.formRegister', ["result"=>$result]); // enviando o $result para a view

    }

    public function viewForm(Request $request){ // poderia ser index(). Função primária que é ixibir formulário. Traz uma view. Na verdade, não precisa usar o request pq não está pegando nenhuma informação, nem get nem post
        return view('products.formRegister'); // a barra é substituída por um ponto e o arquivo fica só form, sem blade.
    }

    public function viewFormUpdate(Request $request, $id=0) { //$id que vem da url {id}
        $product = Product::find($id); // método find: select * from where id=?. $id opcional para ter a rota /atualizar. Poderia ser tb $id=false.
        if($product){
        return view('products.formUpdate', ["product"=>$product]); //segundo parâmetro da função view para passar informações para o form.Update. Vira uma variável dentro da view
        } else {
            return view('products.formUpdate');
        }
    }

    public function update(Request $request){ // $request = new Request
        $product = Product::find($request->idProduct);  
        $product->name = $request->nameProduct; 
        $product->description = $request->descriptionProduct; 
        $product->quantity = $request->quantityProduct; 
        $product->price = $request->priceProduct;
        
        $result = $product->save();

        return view('products.formUpdate', ["result"=>$result]);
    }

    public function delete(Request $request, $id=0){
        $result = Product::destroy($id);
        if($result){
            return redirect('/produtos'); // igual ao header("Location....) 
        }
    }

    public function viewAllProducts(Request $request){
        $listProducts = Product::all();
        return view('products.products', ["listProducts"=>$listProducts]); // "listproducts" vai receber a $listaproducts
    }

    public function viewOneProduct(Request $request){
        // opcional. Product::find($idProduto)
    }


}

