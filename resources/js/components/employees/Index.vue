<template>
    <div>
        <div class="col-xl-12 col-lg-12">
            <div class="alert alert-warning alert-dismissible fade show" role="alert" v-if="showMessage">
                {{ message }}
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>

            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Employee list</h6>
                </div>
                <div class="card-body">
                    <div class="row">
                        <div class="col-md-8">
                            <router-link :to="{name: 'EmployeesCreate'}" class="btn btn-primary">Add new employee</router-link><br><br>
                        </div>
                        <div class="col-md-4">
                            <form class="flex-sm">
                                <div class="input-group">
                                    <input type="search" name="keyword" class="form-control" placeholder="Search" v-model.lazy="search">
                                    <div class="input-group-append">
                                        <button class="btn btn-primary mr-2 rounded-right" type="submit"><i class="fas fa-search"></i></button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                    <table class="table table-hover table-bordered">
                        <thead>
                            <tr align="center">
                                <th width="5%">No</th>
                                <th>#</th>
                                <th>First Name</th>
                                <th>Last Name</th>
                                <th>Address</th>
                            </tr>
                        </thead>
                        <tbody>
                            <tr v-for="(employee, index) in employees" :key="employee.id">
                                <td>{{ index+1 }}</td>
                                <td align="center">
                                    <router-link :to="{name: 'EmployeesEdit', params: {id: employee.id}}" class="btn btn-sm btn-info"><i class="fas fa-pen"></i></router-link>                       
                                    <button class="btn btn-sm btn-danger" @click="deleteEmployee(employee.id)"><i class="fas fa-trash"></i></button>
                                    <!-- <a href="#" id="btn-delete" class="btn btn-sm btn-danger" data-toggle="modal" data-target="#deleteEmployeeModal"><i class="fas fa-trash"></i></a> -->
                                </td>
                                <td>{{ employee.first_name }}</td>
                                <td>{{ employee.last_name }}</td>
                                <td>{{ employee.address }}</td>
                            </tr>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!-- <div class="modal fade" id="deleteEmployeeModal" tabindex="-1" role="dialog">
            <div class="modal-dialog" role="document">
                <form action="javascript:void(0)" id="deleteForm" method="post">    
                    @csrf
                    <div class="modal-content">
                        <div class="modal-header">
                            <h4 class="modal-title" id="vcenter">Delete Employee</h4>
                            <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                <span aria-hidden="true">&times;</span>
                            </button>
                        </div>
                        <div class="modal-body">
                            <p>Are you sure?</p>
                        </div>
                        <div class="modal-footer">
                            <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            <button @click="deleteEmployee(employee.id)" class="btn btn-danger">Delete</button>
                        </div>
                    </div>
                </form>
            </div>
        </div> -->
    </div>
</template>

<script>
export default {
    data() {
        return {
            employees: [],
            showMessage: false,
            search: null,
        }
    },
    watch: {
        search() {
            this.getEmployees();
        }
    },
    created() {
        this.getEmployees()
    },
    methods: {
        getEmployees(){
            axios.get('/api/employee', {
                    params: {
                        search: this.search
                    }
                })
                .then(res => {
                    this.employees = res.data.data
                }).catch(error => {
                    console.log(error)
                })
        },
        deleteEmployee(id) {
            axios.delete("api/employee/" + id).then(res => {
                this.showMessage = true;
                this.message = res.data;
                this.getEmployees();
            });
        }
    }
}
</script>

<style>

</style>