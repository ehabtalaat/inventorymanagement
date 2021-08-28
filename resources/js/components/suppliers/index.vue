
<template>
  
  <div>

 <div class="row">
  <router-link to="/store-supplier" class="btn btn-primary">Add supplier </router-link>
   
 </div>
<br>
   <input type="text" v-model="searchTerm" @keyup="filtersearch()" class="form-control" style="width: 300px;" placeholder="Search Here">


<br>

   <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">supplier List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Photo</th>
                        <th>Phone</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="supplier in suppliers.data" :key="supplier.id">
                        <td> {{ supplier.name }} </td>
                        <td><img :src="supplier.photo" id="em_photo"></td>
                        <td>{{ supplier.phone }}</td>
            <td>
   <router-link :to="{name: 'editsupplier', params:{id:supplier.id}}" class="btn btn-sm btn-primary">Edit</router-link>

 <a @click="deleteEupplier(supplier.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Delete</font></a>
            </td>
                      </tr>
                    
                    </tbody>
                  </table>
                  <pagination :data="suppliers" class="mx-auto" style="align-items: center;
justify-content: center;" @pagination-change-page="allSsupplier">
                    <span slot="prev-nav">&lt; Previous</span>
  <span slot="next-nav">Next &gt;</span>
                  </pagination>
                </div>
                <div class="card-footer"></div>
              </div>
            </div>
          </div>
          <!--Row-->


   
  </div>


</template>



<script type="text/javascript">
  import Swal from 'sweetalert2'
  export default {
    // created(){
    //   if (!User.loggedIn()) {
    //     this.$router.push({name: '/'})
    //   }
    // },
    data(){
      return{
        suppliers:{},
        searchTerm:''
      }
    },
    computed:{
     
    },
 
  methods:{
    allSupplier(page = 1){
      axios.get('/api/supplier/?page=' + page)
      .then(({data}) => (this.suppliers = data))
      .catch()
    },
   filtersearch(){
     axios.post('/api/searchsupplier',{'name' : this.searchTerm})
  .then(({data}) => (this.suppliers = data))
      .catch()
      // return this.employees.filter(employee => {
      //    return employee.name.match(this.searchTerm)
      // }) 
      },
  deleteSupplier(id){
             Swal.fire({
              title: 'Are you sure?',
              text: "You won't be able to revert this!",
              icon: 'warning',
              showCancelButton: true,
              confirmButtonColor: '#3085d6',
              cancelButtonColor: '#d33',
              confirmButtonText: 'Yes, delete it!'
            }).then((result) => {
              if (result.value) {
                axios.delete(`/api/supplier/${id}`)
               .then(() => {
                this.suppliers = this.suppliers.data.filter(supplier => {
                  return supplier.id != id
                })
               this.allSupplier();
               })
               .catch(() => {
                this.$router.push({name: 'supplier'})
               })
                Swal.fire(
                  'Deleted!',
                  'Your file has been deleted.',
                  'success'
                )
              }
            })
  } 
  },
  created(){
    this.allSupplier();
  } 
  
  } 
</script>


<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>