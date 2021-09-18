
<template>
  
  <div>

 <div class="row">
  <router-link to="/createcategory class="btn btn-primary">Add category </router-link>
   
 </div>
<br>
   <input type="text" v-model="searchTerm" @keyup="filtersearch()" class="form-control" style="width: 300px;" placeholder="Search Here">


<br>

   <div class="row">
            <div class="col-lg-12 mb-4">
              <!-- Simple Tables -->
              <div class="card">
                <div class="card-header py-3 d-flex flex-row align-items-center justify-content-between">
                  <h6 class="m-0 font-weight-bold text-primary">category List</h6>
                </div>
                <div class="table-responsive">
                  <table class="table align-items-center table-flush">
                    <thead class="thead-light">
                      <tr>
                        <th>Name</th>
                        <th>Action</th>
                      </tr>
                    </thead>
                    <tbody>
                      <tr v-for="category in categorys.data" :key="category.id">
                        <td> {{ category.name }} </td>
                     
            <td>
   <router-link :to="{name: 'editcategory', params:{id:category.id}}" class="btn btn-sm btn-primary">Edit</router-link>

 <a @click="deletecategory(category.id)" class="btn btn-sm btn-danger"><font color="#ffffff">Delete</font></a>
            </td>
                      </tr>
                    
                    </tbody>
                  </table>
                  <pagination :data="categorys" class="mx-auto" style="align-items: center;
justify-content: center;" @pagination-change-page="filtersearch">
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
        categorys:{},
        searchTerm:''
      }
    },
    computed:{
     
    },
 
  methods:{
    allcategory(page = 1){
      axios.get('/api/searchcategory/?page=' + page)
      .then(({data}) => (this.categorys = data))
      .catch()
    },
   filtersearch(page = 1){
     axios.post('/api/searchcategory/?page=' + page,{'name' : this.searchTerm})
  .then(({data}) => (this.categorys = data))
      .catch()
      // return this.employees.filter(employee => {
      //    return employee.name.match(this.searchTerm)
      // }) 
      },
  deletecategory(id){
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
                axios.delete(`/api/category/${id}`)
               .then(() => {
                this.categorys = this.categorys.data.filter(category => {
                  return category.id != id
                })
               this.filtersearch();
               })
               .catch(() => {
                this.$router.push({name: 'category'})
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
    this.filtersearch();
  } 
  
  } 
</script>


<style type="text/css">
  #em_photo{
    height: 40px;
    width: 40px;
  }
</style>