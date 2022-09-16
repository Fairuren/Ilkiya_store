<?php

namespace App\Http\Controllers;
use App\Models\Book;
use App\Models\Preview;
use Illuminate\Http\Request;
use App\DataTables\BookDataTable; 
use App\Models\Writer;
use App\Models\Publisher;
use App\Models\Category;
use App\Models\Order;
use App\Models\Cart;
use PDF;

use Illuminate\Support\Str;

class ProductController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(  )
   
    {
        $books = Book::getAllBook();
        
        return view('admin.product.index')->with('books', $books);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $publishers=Publisher::get();
        $category=Category::get();
        $writers = Writer::get();
        return view('admin.product.create')->with("publishers", $publishers)->with("category", $category)->with("writers", $writers);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $this->validate($request,[
            'name' => 'string|required',
            'isbn' => 'string|required',
            'summary'=>'string|required',
            'description'=>'string|nullable',
            'image'=>'image|file|max:2048|required',
            'stock'=>"required|numeric",
            'category_id'=>'required|exists:category,id',
            'publisher_id'=>'required|exists:publishers,id',
            'writer_id'=>'required|exists:writer,id',
            'status'=>'required|in:active,inactive',
            'price'=>'required|numeric',
            'discount' => 'required|numeric',
            'p1' => 'string|required',
            'p2' => 'string|required',
            'p3' => 'string|required',
            'p4' => 'string|required',
            'p5' => 'string|required',
            'p6' => 'string|required',
            'p7' => 'string|required',

        ]);
      
        $book = $request->all();
       
        //store image 
     
        if($request->file('image')){
            $request->file('image')->store('images');
            $book['image'] = $request->file('image')->hashName();    
        }
     
        $slug = Str::slug($request->name);
        
        //make sure slug unique in database and if exist add a number to the end of slug
        // $count = Book::where('slug', $slug)->count();
        // if($count > 0){
        //     $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        // };

        $book['slug'] = $slug;

        $status=Book::create($book);
         
        if($status){

            $preview =  [
                ['preview'=> $book['p1'], 'book_id'=> $status->id, 'page' => 1],
                ['preview'=> $book['p2'], 'book_id'=> $status->id, 'page' => 2],
                ['preview'=> $book['p3'], 'book_id'=> $status->id, 'page' => 3],
                ['preview'=> $book['p4'], 'book_id'=> $status->id, 'page' => 4],
                ['preview'=> $book['p5'], 'book_id'=> $status->id, 'page' => 5],
                ['preview'=> $book['p6'], 'book_id'=> $status->id, 'page' => 6],
                ['preview'=> $book['p7'], 'book_id'=> $status->id, 'page' => 7],
                //...
            ];
    
            $done = Preview::insert($preview);
            if($done){
                request()->session()->flash('success','Product Successfully added');
            }
            else{
                request()->session()->flash('error','Please try again!!');
            }
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('product.index');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {

        $publishers=Publisher::get();
        $product=Book::findOrFail($id);
        $category=Category::get();
        $writers = Writer::get();
        // return $items;
        return view('admin.product.edit')->with('product',$product)
                    ->with('publishers',$publishers)
                    ->with('category',$category)
                    ->with('writers',$writers);
       
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {


        $book=Book::findOrFail($id);
        $this->validate($request,[
            'name' => 'string|required',
            'summary'=>'string|required',
            'isbn' => 'string|required',
            'description'=>'string|nullable',
            'image'=>'image|file|max:2048',
            'stock'=>"required|numeric",
            'category_id'=>'required|exists:category,id',
            'publisher_id'=>'required|exists:publishers,id',
            'writer_id'=>'required|exists:writer,id',
            'status'=>'required|in:active,inactive',
            'price'=>'required|numeric',
            'discount' => 'required|numeric'
        ]);


        $data = $request->all();
        //store image 

        // if($request->file('image')){
        //     $request->file('image')->store('images');
        //     $book['image'] = $request->file('image')->hashName();    
        // }
       
        if($request->file('image')){
            $request->file('image')->store('images');    
            $book['image'] = $request->file('image')->hashName();    
        }
        $data['image'] = $book['image'];
    
        $slug = Str::slug($request->name);
        
        //make sure slug unique in database and if exist add a number to the end of slug
        // $count = Book::where('slug', $slug)->count();
        // if($count > 0){
        //     $slug=$slug.'-'.date('ymdis').'-'.rand(0,999);
        // };

        $data['slug'] = $slug;


        $status=$book->fill($data)->save();
        if($status){
            request()->session()->flash('success','Product Successfully added');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('product.index');
    }

    public static function EditDiscount(Request $request, $id){
        $book=Book::findOrFail($id);
        $book['discount'] = $request->discount;
        $status=$book->save();
        if($status){
            request()->session()->flash('success','Discount Updated');
        }
        else{
            request()->session()->flash('error','Please try again!!');
        }
        return redirect()->route('book.discount');
    }
    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $product=Book::findOrFail($id);
        $status=$product->delete();
        
        if($status){
            request()->session()->flash('success','Product successfully deleted');
        }
        else{
            request()->session()->flash('error','Error while deleting product');
        }
        return redirect()->route('product.index');
    }

    public function GetSoldBooks(){
        $books = Cart::where('order_id', '!=', null)->get();
       
        return view('admin.product.sold')->with('books', $books);
    }

    public function GetDiscount(){
        $books = Book::where('discount', '!=', 0)->get();
       
        return view('admin.product.discount')->with('books', $books);
    }
    public function all_book_pdf(Request $request)
    {
        $book=Book::getAllBooksReport($request->start, $request->end);
        // return $order;

        // return $file_name;
      
    
        $pdf=PDF::loadview('client.layout.print.allbooks',compact('book'), ['start' => $request->start, 'end' => $request->end]);
        return $pdf->stream('allbooks.pdf');

    }

    public function all_sold_pdf(Request $request)
    {
        $book=Book::getAllSoldReport($request->start, $request->end);
        // return $order;

        // return $file_name;
      
    
        $pdf=PDF::loadview('client.layout.print.allsold',compact('book'), ['start' => $request->start, 'end' => $request->end]);
        return $pdf->stream('allsold.pdf');

    }

    public function all_discount_pdf(Request $request)
    {
        $book=Book::getAllDiscount($request->start, $request->end);
        // return $order;

        // return $file_name;

        $pdf=PDF::loadview('client.layout.print.alldiscount',compact('book'), ['start' => $request->start, 'end' => $request->end]);
        return $pdf->stream('alldiscount.pdf');

    }
}
