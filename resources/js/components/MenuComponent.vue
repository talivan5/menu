<template>
     <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-10">
                <button type="button" class="btn btn-sm btn-primary pull-center" @click.prevent="nuevo()">
                    <i class="fa fa-plus"></i>Menu
                </button>
                <hr>
                <table class="table">
                    <thead class="thead-dark">
                        <tr>
                            <th scope="col">N°</th>
                            <th scope="col">Nombre</th>
                            <th scope="col">URL</th>
                            <th scope="col">Orden</th>
                            <th scope="col">Icono</th>
                            <th scope="col">Operaciones</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr v-for="menu in menus" :key="menu.menu_id">
                            <th scope="row">{{menu.menu_id}}</th>
                            <td>{{menu.nombre}}</td>
                            <td>{{menu.url}}</td>
                            <td>{{menu.orden_id}}</td>
                            <td>{{menu.icono}}</td>
                            <td>
                                <div class="text-center">
                                    <a href="#" class="btn btn-sm btn-danger pull-center" @click="confirmar(menu)">
                                        <i class="fa fa-trash-alt" aria-hidden="true"></i>
                                    </a>
                                    <a href="#" class="btn btn-sm btn-success pull-center" @click="modificar(menu)">
                                        <i class="fa fa-edit"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>

        <div class="modal fade" id="create">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Esta seguro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="menu">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" v-model="menu.nombre">
                        </div>
                        <div class="form-group">
                            <label for="menu">URL:</label>
                            <input type="text" class="form-control" name="url" v-model="menu.url">
                        </div>
                        <div class="form-group">
                            <label for="menu">Orden:</label>
                            <input type="text" class="form-control" name="orden_id" v-model="menu.orden_id">
                        </div>
                        <select class="form-control" v-model="menu.orden_id">
                            <option v-for="menu in menus" :key="menu.menu_id" v-bind:value="orden_menu.num_orden"> {{orden_menu.nombre_submenu}}</option>
                        </select>
                        <div class="form-group">
                            <label for="menu">Icono:</label>
                            <input type="text" class="form-control" name="icono" v-model="menu.icono">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                <a type="button" class="btn btn-sm btn-primary" @click.prevent="crear()"><i class="fa fa-save"></i>Guardar</a>
                            </div>
                            <div class="col-sm-6 text-right">
                                <button type="button" class="btn btn-sm btn-secondary" data-dismiss="modal"><i class="fa fa-ban">Cancelar</i></button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="editar">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Editar Permiso</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                            <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="form-group">
                            <label for="menu">Nombre:</label>
                            <input type="text" class="form-control" name="nombre" v-model="menu.nombre">
                        </div>
                        <div class="form-group">
                            <label for="menu">URL:</label>
                            <input type="text" class="form-control" name="url" v-model="menu.url">
                        </div>
                        <div class="form-group">
                            <label for="menu">Icono:</label>
                            <input type="text" class="form-control" name="icono" v-model="menu.icono">
                        </div>
                        <div class="form-group">
                            <label for="menu">Orden:</label>
                            <input type="text" class="form-control" name="orden_id" v-model="menu.orden_id">
                        </div>
                    </div>
                    <div class="modal-footer">
                        <div class="row">
                            <div class="col-sm-6 text-left">
                                <a type="button" class="btn btn-sm btn-success pull-center" @click.prevent="editar()">
                                    <i class="fa fa-check">Actualizar</i>
                                </a>
                            </div>
                            <div class="col-sm-6 text-right">
                                <button type="button" class="btn btn-sm btn-secondary pull-center" data-dismiss="modal">
                                    <i class="fa fa-ban">Cancelar</i>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        <div class="modal fade" id="confirmar">
            <div class="modal-dialog" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title">Esta seguro</h5>
                        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                    <div class="modal-body">
                        ¿Esta seguro de eliminar el permiso?
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-success" @click="eliminar(menu)"><i class="fa fa-check"></i> Aceptar</button>
                        <button type="button" class="btn btn-danger" data-dismiss="modal"><i class="fa fa-ban"></i> Cancelar</button>
                    </div>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
    export default {
        data(){
            return {
                menus:[],
                menu_id:'',
                nombre:'',
                url:'',
                orden_id:'',
                icono:'',
                orden_menus:[],
                id:'',
                num_orden:'',
                menu:{
                    nombre:'',
                    url:'',
                    orden_id:'',
                    icono:''
                },
                orden_menu:{
                    id:'',
                    num_orden:'',
                    nombre_submenu:''
                }
            }
        },
        methods:{
            listar(){
                let me =this;
                axios.get('http://127.0.0.1:8000/api/menus')
                .then(function(response){
                    me.menus=response.data.response;
                })
                .catch(function(error)
                {
                    console.log(error);
                })
            },
            listarsubmenu(){
                let me =this;
                axios.get('http://127.0.0.1:8000/api/ordenmenus')
                .then(function(response){
                    me.orden_menu=response.data.menu;
                    console.log(response);
                })
                .catch(function(error)
                {
                    console.log(error);
                })
            },

            eliminar(menu){
                let me = this;
                axios.delete('http://127.0.0.1:8000/api/menus/' + menu.menu_id)
                .then(response=>{
                    $('#confirmar').modal('hide');
                    me.listar();
                })
                    .catch(function (error){
                    console.log(error);
                })
            },
             crear(){
                let me = this;
                axios.post('http://127.0.0.1:8000/api/menus',
                {
                    'nombre'    :me.menu.nombre,
                    'url'       :me.menu.url,
                    'orden_id'  :me.menu.orden_id,
                    'icono'     :me.menu.icono
                })
                .then(response=>{
                    $('#create').modal('hide');
                    me.listar();
                    me.nombre   ='';
                    me.url      ='';
                    me.orden_id ='';
                    me.icono    ='';
                }).catch(error => {
                    me.errors=error.response.data;
                });
            },
            modificar(menu){
                $('#editar').modal({ backdrop: 'static', keyboard: false, show: true });
                this.menu_id=menu.menu_id;
                this.menu.nombre=menu.nombre;
                this.menu.url=menu.url;
                this.menu.orden_id=menu.orden_id;
                this.menu.icono=menu.icono;
            },
             nuevo(){
                $('#create').modal({ backdrop: 'static', keyboard: false, show: true });
            },
            editar(){
                let me = this;
                axios.put('http://127.0.0.1:8000/api/menus/'+ me.menu_id,
                {
                    'nombre'    :me.menu.nombre,
                    'url'       :me.menu.url,
                    'orden_id'     :me.menu.orden_id,
                    'icono'     :me.menu.icono
                })
                .then(response=>{
                    $('#editar').modal('hide');
                    me.listar();
                    me.menu.nombre  ='';
                    me.menu.url     ='';
                    me.menu.orden_id   ='';
                    me.menu.icono   ='';
                }).catch(error => {
                    me.errors=error.response.data;
                });
            },
            confirmar(menu){
                this.menu.menu_id = menu.menu_id;
                $('#confirmar').modal({ backdrop: 'static', keyboard: false, show: true });
            },
            asignar(menu){
                let me=this;
                axios.put('http://127.0.0.1:8000/api/orden_menus/',
                {

                })
            }
        },
        mounted() {
            this.listar();
            this.listarsubmenu();
        }
    }
</script>
