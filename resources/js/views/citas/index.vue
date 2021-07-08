<template>
  <div class="content-wrapper">
            <div class="content-body">
                <!-- card actions section start -->
                <section id="card-actions">

                    <!-- Info table about action starts -->
                    <div class="row d-flex align-items-center">
                        <div class="col-12">
                            <div class="card">
                                <div class="card-header bg-primary  pt-1 pb-1">
                                    <h4 class="card-title text-white"><i class="feather icon-grid"></i> Citas Psicològica</h4>
                                   <div class="heading-elements pt-0 mt-0">
                                        <ul class="list-inline mb-0 pt-0 mt-0 display">
                                         <li class="pt-0 mt-0">
                                                <button class="btn btn-sm btn-link text-white" @click.prevent="clickCreate()"><i class="fa fa-file-o"></i> Nuevo</button>
                                          </li>
                                           <li class="pt-0 mt-0">
                                                <button class="btn btn-sm btn-link text-white" @click.prevent="clickPDF()"><i class="fa fa-file-pdf-o"></i> PDF</button>
                                          </li>
                                        </ul>
                                    </div> 
                                </div>
                                <div class="card-content collapse show">
                                    <div class="card-body p-0">
                                        <div class="row">
                                            <div class="col-sm-12">
                                                <data-table :resource="resource" :type="type">
                                                    <tr slot="heading">
                                                          <th class="text-center">Nº</th>
                                                        <th class="text-center">Nombres y Apellidos</th>
                                                        <th class="text-center">Edad</th>
                                                         <th class="text-center">Grado</th>
                                                        <th class="text-center">Numero Padre</th> 
                                                        <th class="text-center">Resposable</th> 
                                                        <th class="text-center">Fecha</th> 
                                                        <th class="text-center">Asunto</th> 
                                                        <th class="text-center">#</th>
                                                    <tr>
                                                    <tr slot-scope="{ index, row }" :class="{ disable_color : !row.enabled}">
                                                         <td class="text-center">{{ index }}</td>
                                                       <td class="text-center">{{ row.student.name}}{{ row.student.surnames}}</td>
                                                        <td class="text-center"> {{row.student.age}} </td>
                                                        <td class="text-center"> {{row.student.grade}} </td>
                                                        <td class="text-center"> {{row.student.phone}} </td>
                                                        <td class="text-center"> {{row.user.name}}</td>
                                                        <td class="text-center"> {{row.date}}</td>
                                                        <td class="text-center"> {{row.affair}}</td>
                                                    <td class="text-right">
                                                        <el-button-group>   
                                                       
                                                       <el-tooltip class="item" effect="light" content="Eliminar" placement="bottom">
                                                             <el-button type="danger" icon="el-icon-delete" @click.prevent="clickDelete(row.id)"></el-button>
                                                        </el-tooltip>
                                                         <el-tooltip class="item" effect="light" content="Modificar" placement="bottom">
                                                             <el-button type="primary" icon="el-icon-edit" @click.prevent="clickCreate(row.id)"></el-button>
                                                        </el-tooltip>
                                                        </el-button-group>
                                                        </td>
                                                    </tr>
                                                </data-table>
                                            </div>
                                        </div>
                                          <template>
                                             <QuotesForm
                                                :showDialog.sync="showDialog"
                                                :loadingForm.sync="loadingForm"
                                                :recordId.sync="recordId"
                                                :titleDialog.sync="titleDialog">
                                             </QuotesForm>
                                        </template>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                    <!-- Info table about action Ends -->
                </section>
                <!-- // card-actions section end -->

            </div>
        </div>      
</template>

 

<script>
 //const cityOptions = [];
  import QuotesForm from './form.vue'
import {functions} from '../../mixins/functions'
import DataTable from '../../components/DataTable.vue'
  import {deletable} from '../../mixins/deletable'
import { Loading } from 'element-ui';

import _ from "lodash";
export default {
  mixins: [functions,deletable],
   components: { DataTable,QuotesForm},
    
  data() {
    return {
      loading_submit: false,
      loadingForm:false,  
      resource: "quotes",
      titleDialog:"Listado de Usuario",
      array_data:[],
      type:'1',
      recordId:null,
      showDialog:false,
    };
  },

  async created() {
      /*  return this.$http.get(`/users/tables`).then((response) => {
        this.typeUser=response.data.typeuser.type
        });
        */
  },

  methods: {
 
     clickReset(id) {
        this.reset(`/${this.resource}/reset/${id}`).then(() =>
            this.$eventHub.$emit('reloadData')
        )
    },
    clickPDF(){
         window.open(`/${this.resource}/exportar`, '_blank');
    },
     clickCreate(recordId = 0) {
         this.showDialog=true
            if(recordId!=0){
            this.recordId = recordId;
            this.loadingForm=true
             this.titleDialog="Modificar Cita"
        }else{
            this.loadingForm=false;
            this.titleDialog="Registrar Nuevo Cita"   
        }
    },
    async create() {
          this.$http.get(`/users/tables`)
                .then(response => {
               // this.typeUser=response.data.typeuser
            })
        /*
        this.loadingForm = true;
         const response=await this.$http.get(`/user/records`);
         this.array_data=response.data;
       
        this.loadingForm = false;
      */
     
      },
      
         submit() {
            this.loading_submit = true
            this.$http.post(`/${this.resource}/save_perfil`, this.form)
            .then(response => {
                if (response.data.success) {
                    this.$message.success(response.data.message)
                } else {
                    this.$message.error(response.data.message)
                }

            })
            .catch(error => {
                if (error.response.status === 422) {
                 //   console.log(error.response.data.error)
                    this.errors = error.response.data.error
                } else {
                    console.log(error)
                 }
            })
            .then(() => {
                this.loading_submit = false
            })
             /*
        this.loading_submit = true
        this.$http.post(`/${this.resource}/save_perfil`, this.form)
            .then(response => {
                if (response.data.success) {
                    this.$message.success(response.data.message)
                   location.reload();
                } else {
                    this.$message.error(response.data.message)
                }
                
            })
            .catch(error => {
                if (error.response.status === 422) {
                    this.errors = error.response.data.errors
                } else {
                    console.log(error)
                 }
            })
            .then(() => {
                this.loading_submit = false
            })
            */
    },
    clickDelete(id) {
        this.destroy(`/${this.resource}/${id}`).then(() =>
            this.$eventHub.$emit('reloadData')
        )
    },
    close() {
      this.active = 0;
      this.$emit("update:recordId", 0);
      this.initForm();
    } 
    },

  }
</script>
