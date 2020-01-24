<?php

namespace App\Http\Controllers;

use App\Menu;
use App\OrdenMenu;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB as FacadesDB;

class MenuController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $menus = FacadesDB::table('menu')
        ->join('orden_menu','menu.orden_id','=','orden_menu.id')
        ->get();
        $data=[];
        foreach ($menus as $key => $menu){
            $submenu =OrdenMenu::where('orden_menu.id',$menu);
            $data[]=array(
                'menu'=> $menu,
                'submenu'=> $submenu
            );
        }
        return response()->json($data);

    }
    public function ordenmenus(){
        $ordenmenus = OrdenMenu::all();
        $response = [
            'status' => true,
            'response' => $ordenmenus
        ];
        return response()->json($response);
    }



    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        Menu::create([
            'nombre'        => $request->nombre,
            'url'           => $request->url,
            'orden_id'      => $request->orden_id,
            'icono'         => $request->icono,
        ]);

        return response()->json([
                'status' => false,
                'slug' => 'DATA_CANNOT_BE_SAVED'
            ], 200);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function show(Menu $menu)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function edit(Menu $menu)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $menu = Menu::find($id);
        $menu->nombre = $request->nombre;
        $menu->url    = $request->url;
        $menu->orden_id  = $request->orden_id;
        $menu->icono  = $request->icono;
        $menu->save();
        return response()->json([
            'status' => true,
        ], 200);
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Menu  $menu
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        FacadesDB::table("menu")->where('menu_id',$id)->delete();
        return response()->json([
            'status' => true
        ], 200);
    } public function listar(){
        return view('menu.index');
    }

}
