<template>
  <div class="hello">
    <h2>Employee Reg:</h2>
    <div class="row">
        <div class="col-md-6 m-auto">
            <form @submit.prevent="save">
                <div class="mb-3">
                    <label>Employee Name:</label>
                    <input type="text" v-model="employee.name" class="form-control" placeholder="Email">
                </div>
                <div class="mb-3">
                    <label>Employee Address:</label>
                    <input type="text" v-model="employee.address" class="form-control" placeholder="Address">
                </div>
                <div class="mb-3">
                    <label>Employee Mobile:</label>
                    <input type="text" v-model="employee.mobile" class="form-control" placeholder="Mobile">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
        
    </div>
    

    <h2 class="mt-4">Employee View</h2>
    <table class="table table-dark table-striped">
        <thead>
            <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Address</th>
                <th scope="col">Mobile</th>
                <th scope="col">Action</th>
            </tr>
        </thead>
        <tbody>
            <tr v-for="employee in result" v-bind:key="employee.id">
                <th scope="row">{{ employee.id }}</th>
                <td>{{ employee.name }}</td>
                <td>{{ employee.address }}</td>
                <td>{{ employee.mobile }}</td>
                <td>
                    <button class="btn btn-sm btn-warning" @click="edit(employee)">Edit</button>
                    <button class="btn btn-sm btn-danger" @click="destroy(employee)">Delete</button>
                </td>
            </tr>
        </tbody>
    </table>

  </div>
</template>

<script>
import Vue from 'vue'
import axios from 'axios'
Vue.use(axios)


export default {
  name: 'HelloWorld',
  data () {
    return {
      result: [],
      employee: {
        id: '',
        name: '',
        address: '',
        mobile: '',
      }
    }
  },
  created(){
    this.EmployeeLoad()
  },
  methods: {
    EmployeeLoad(){
        var page = 'http://127.0.0.1:8000/api/employees';
        axios.get(page)
        .then(({data})=>{
            console.log(data);
            this.result = data;
        })
    },
    save() {
        if(this.employee.id == ''){
            this.savedata();
        }else{
            this.updateData();
        }
    },
    savedata() {
        axios.post("http://127.0.0.1:8000/api/save", this.employee)
        .then(({data})=>{
            alert('data save')
        })
    },
    edit(employee){
        this.employee = employee;
    },
    updateData(){
        var edit = 'http://127.0.0.1:8000/api/update/' + this.employee.id;
        axios.post(edit, this.employee)
        .then(({data})=>{
            this.employee.name = '';
            this.employee.address = '';
            this.employee.mobile = '';
            this.employee.id = '';
            alert('Data Upated');
            this.EmployeeLoad()
        }).catch(error => {
            console.error("Error updating data:", error);
        });
    },

    destroy(employee){
        var deleteData = 'http://127.0.0.1:8000/api/delete/'+ employee.id;
        axios.delete(deleteData)
        .then(response => {
            alert('Data Deleted');
            this.EmployeeLoad();
        })
        .catch(error => {
            console.error("Error deleting data:", error);
        });
    }
  }
}
</script>

