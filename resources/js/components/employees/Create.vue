<template>
    <div>
        <div class="col-xl-12 col-lg-12">
            <div class="card shadow mb-4">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                    <h6 class="m-0 font-weight-bold text-primary">Create new employee</h6>
                </div>
                <div class="card-body">
                    <form @submit.prevent="storeEmployee">
                        <div class="form-group row">
                            <label for="first_name" class="col-md-4 col-form-label text-md-right">first_name</label>

                            <div class="col-md-6">
                                <input id="first_name" v-model="form.first_name" type="text" class="form-control" name="first_name" value="" required autocomplete="first_name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="middle_name" class="col-md-4 col-form-label text-md-right">middle_name</label>

                            <div class="col-md-6">
                                <input id="middle_name" v-model="form.middle_name" type="text" class="form-control" name="middle_name" value="" required autocomplete="middle_name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="last_name" class="col-md-4 col-form-label text-md-right">last_name</label>

                            <div class="col-md-6">
                                <input id="last_name" v-model="form.last_name" type="text" class="form-control" name="last_name" value="" required autocomplete="last_name" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="address" class="col-md-4 col-form-label text-md-right">address</label>

                            <div class="col-md-6">
                                <input id="address" v-model="form.address" type="text" class="form-control" name="address" value="" required autocomplete="address" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="country_id" class="col-md-4 col-form-label text-md-right">country_id</label>

                            <div class="col-md-6">
                                <select v-model="form.country_id" @change="getStates()" name="country" class="form-control">
                                    <option v-for="country in countries" :key="country.id" :value="country.id">
                                        {{ country.name }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="state_id" class="col-md-4 col-form-label text-md-right">state_id</label>

                            <div class="col-md-6">
                                <select v-model="form.state_id" @change="getCities()" name="state" class="form-control">
                                    <option v-for="state in states" :key="state.id" :value="state.id">
                                        {{ state.name }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="city_id" class="col-md-4 col-form-label text-md-right">city_id</label>

                            <div class="col-md-6">
                                <select v-model="form.city_id" name="city" class="form-control">
                                    <option v-for="city in cities" :key="city.id" :value="city.id">
                                        {{ city.name }}
                                    </option>
                                </select>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="zip_code" class="col-md-4 col-form-label text-md-right">zip_code</label>

                            <div class="col-md-6">
                                <input id="zip_code" v-model="form.zip_code" type="text" class="form-control" name="zip_code" value="" required autocomplete="zip_code" autofocus>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="birthdate" class="col-md-4 col-form-label text-md-right">birthdate</label>

                            <div class="col-md-6">
                                <datepicker v-model="form.birthdate" input-class="form-control"></datepicker>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="date_hired" class="col-md-4 col-form-label text-md-right">date_hired</label>

                            <div class="col-md-6">
                                <datepicker v-model="form.date_hired" input-class="form-control"></datepicker>
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Create
                                </button>
                                <router-link :to="{name: 'EmployeesIndex'}" class="btn btn-secondary">Back</router-link>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</template>

<script>
import Datepicker from 'vuejs-datepicker'
import moment from 'moment'

export default {
    components: {
        Datepicker
    },
    data() {
        return {
            countries: [],
            states: [],
            cities: [],
            form: {
                first_name: "",
                last_name: "",
                middle_name: "",
                address: "",
                country_id: "",
                state_id: "",
                city_id: "",
                zip_code: "",
                birthdate: null,
                date_hired: null
            }
        };
    },
    created() {
        this.getCountries();
    },
    methods: {
        getCountries(){
            axios.get('/api/employee/countries')
                .then(res => {
                    this.countries = res.data
                }).catch(error => {
                    console.log(console.error)
                });
        },
        getStates(){
            axios.get('/api/employee/'+ this.form.country_id + '/states')
                .then(res => {
                    this.states = res.data
                }).catch(error => {
                    console.log(console.error)
                });
        },
        getCities(){
            axios.get('/api/employee/'+ this.form.state_id + '/cities')
                .then(res => {
                    this.cities = res.data
                }).catch(error => {
                    console.log(console.error)
                });
        },
        storeEmployee() {
            axios.post("/api/employee", {
                    first_name: this.form.first_name,
                    middle_name: this.form.middle_name,
                    last_name: this.form.last_name,
                    address: this.form.address,
                    country_id: this.form.country_id,
                    state_id: this.form.state_id,
                    city_id: this.form.city_id,
                    zip_code: this.form.zip_code,
                    birthdate: this.format_date(this.form.birthdate),
                    date_hired: this.format_date(this.form.date_hired)
                })
                .then(res => {
                    this.$router.push({ name: "EmployeesIndex" });
                });
        },
        format_date(value) {
            if (value) {
                return moment(String(value)).format("YYYYMMDD");
            }
        }
    }
}
</script>
