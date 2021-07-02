<template>
      <div >
    <div class="row justify-content-center">
      <div class="col-xl-10 col-lg-12 col-md-9">
        <div class="card shadow-sm my-5">
          <div class="card-body p-0">
            <div class="row">
              <div class="col-lg-12">
                <div class="login-form">
                  <div class="text-center">
                    <h1 class="h4 text-gray-900 mb-4">Login</h1>
                  </div>
                  <form class="user" @submit.prevent="signin()">
                    <div class="form-group">
                      <input type="text" class="form-control" id="name" 
                        placeholder="Enter Name" v-model="form.name" required="required">
                    </div>
                    <div class="form-group">
                      <input type="password" class="form-control" required="required"  v-model="form.password" id="exampleInputPassword" placeholder="Password">
                    </div>
                    <div class="form-group">
                     <!--  <div class="custom-control custom-checkbox small" style="line-height: 1.5rem;">
                        <input type="checkbox" class="custom-control-input" id="customCheck">
                        <label class="custom-control-label" for="customCheck">Remember
                          Me</label>
                      </div> -->
                    </div>
                    <div class="form-group">
                      <button  type="submit" class="btn btn-primary btn-block">Login</button>
                    </div>
                    <hr>
                 
                  </form>
                  <hr>
                  <div class="text-center">
                     <router-link to="/register2" class="font-weight-bold small">Create an Account!</router-link>
                  </div>
                  <div class="text-center">
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</template>

<script>
    export default {
       data(){
        return{
            form:{
                name:null,
                password:null
            }
        }
       },
       methods:{
        signin(){
 axios.post("/api/signin",this.form)
 .then(res => console.log(res.data))
 .catch(error => console.log(error.response.data))
        }
       }
    }
</script>
