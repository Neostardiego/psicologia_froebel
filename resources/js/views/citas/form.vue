<template>
<el-dialog :visible="showDialog" :title="titleDialog" @open="create" 
     :close-on-click-modal="false" :close-on-press-escape="false" :show-close="false" width="30%"> 

 <form autocomplete="off" @submit.prevent="submit">
    <div class="form-body" v-loading="loader"  :element-loading-text="text_loader">
        <div class="row">                                   
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-12 col-xl-12">
                <div class="form-group" :class="{'has-danger': errors.grade}">
                    <label class="control-label w-100">Grado </label>
                        <el-select v-model="form.grade" placeholder="Seleccione Grado" class="w-100" @change="filter"> 
                        <el-option
                        v-for="item in array_grade"
                        :key="item.value"
                        :label="item.label"
                        :value="item.value">
                        </el-option>
                        </el-select>
                    <small class="text-danger" v-if="errors.grade" v-text="errors.grade[0]"></small>
                </div>
            </div>
           <div class="col-xs-12 col-sm-6 col-md-6 col-lg-12 col-xl-12">
                <div class="form-group" :class="{'has-danger': errors.student_id}">
                    <label class="control-label w-100">Alumno </label>
                        <el-select v-model="form.student_id" placeholder="Seleccione Alumno" class="w-100">
                        <el-option
                        v-for="item in array_student"
                        :key="item.id"
                        :label="item.student"
                        :value="item.id">
                        </el-option>
                        </el-select>
                    <small class="text-danger" v-if="errors.student_id" v-text="errors.student_id[0]"></small>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-12 col-xl-12">
                <div class="form-group" :class="{'has-danger': errors.user_id}">
                    <label class="control-label w-100">Responsable </label>
                    <b>{{responsable}}</b>
                    <small class="text-danger" v-if="errors.user_id" v-text="errors.user_id[0]"></small>
                </div>
            </div>
            <div class="col-xs-12 col-sm-6 col-md-6 col-lg-12 col-xl-12">
                <div class="form-group" :class="{'has-danger': errors.affair}">
                    <label class="control-label">Asunto</label>
                    <el-input v-model="form.affair"  type="textarea" autosize></el-input>
                    <small class="text-danger" v-if="errors.affair" v-text="errors.affair[0]"></small>
                </div>
            </div>

           <div class="col-xs-12 col-sm-6 col-md-6 col-lg-12 col-xl-12">
                <div class="form-group" :class="{'has-danger': errors.date}">
                    <label class="control-label w-100">Fecha</label>
                   <el-date-picker format="dd-MM-yyyy" class="w-100" v-model="form.date"  type="date"></el-date-picker>
                    <small class="text-danger" v-if="errors.date" v-text="errors.date[0]"></small>
                </div>
            </div>
        </div>
    </div>
    <div class="form-actions text-right mt-1">
        <el-button type="primary" native-type="submit" :loading="loading_submit">Guardar</el-button>
             <el-button @click="cerrar()">Cancelar</el-button>
    </div>
</form>  
</el-dialog>   
</template>
 
<style>
.el-input__inner{
    width:100% !important;
}

</style>
<script>
//import {EventBus} from '../../../helpers/bus'

    export default {
        props: ['showDialog', 'recordId','titleDialog'],    
        data() {            
            return {
                loading_submit: false,
                resource: 'quotes',
                errors: {},
                form: {},
                responsable:null,
                types: [],
                array_student:[],
                array_grade:[],
                loader: false,
                text_loader: '',
                array_grade: [
                    {
                    value: '1ro',
                    label: '1ro'
                    }, {
                    value: '2do',
                    label: '2do'
                    }, {
                    value: '3er',
                    label: '3er'
                    }, {
                    value: '4to',
                    label: '4to'
                    }, {
                    value: '5to',
                    label: '5to'
                }],
            }
        },
        async created() {
            await this.initForm()
          //  await this.create();
        },
        methods: {
            initForm() {
                this.errors = {}
                this.form = {
                    id: null,
                    student_id: null,
                    user_id: null,
                    date: null,
                    affair: null,
                    grade:null
                }
            },
            async filter(){
                this.form.student_id=null  
                let grade=this.form.grade
                await this.$http.get(`/quotes/filter?grade=`+grade).then((response) => {
                 this.array_student=response.data.students
                });
            },
            async create() {
                this.initForm()
                 let grade=""
                 await this.$http.get(`/quotes/tables`).then((response) => {
                // this.array_student=response.data.students
                 this.form.user_id=response.data.user_id
                 this.responsable=response.data.responsable
                });
                if (this.recordId) {
                    this.loader=true
                      const resp= await this.$http.get(`/${this.resource}/record/${this.recordId}`)
                      this.form = resp.data.data
                      const respuesta= await this.$http.get(`/quotes/filter?grade=`+this.form.grade)
                      this.array_student=respuesta.data.students  
                    /*this.$http.get(`/${this.resource}/record/${this.recordId}`)
                    .then(response => {
                        this.form = response.data.data
                        grade=this.form.grade
                    })*/
                    /*await this.$http.get(`/quotes/filter?grade=`+grade).then((response) => {
                        this.array_student=response.data.students
                    });*/

                    this.loader=false
                }
            },
           
            submit() {
                this.loading_submit = true
                this.$http.post(`/${this.resource}`, this.form)
                    .then(response => {
                        if (response.data.success) {
                            this.$message.success(response.data.message)
                            this.$eventHub.$emit('reloadData')
                            this.cerrar()
                        } else {
                            this.$message.error(response.data.message)
                        }
                    })
                    .catch(error => {
                        if (error.response.status === 422) {
                            this.errors = error.response.data
                        } else {
                            this.$message.error(error.response.data.message);
                            console.log(error)
                        }
                    })
                    .then(() => {
                        this.loading_submit = false
                    })
            },
          
            cerrar() {
                this.$emit('update:showDialog', false)
                this.$emit('update:recordId', null)
                this.initForm()
            },
        }
    }
</script>
