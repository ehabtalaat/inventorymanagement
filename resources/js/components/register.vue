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
                    <h1 class="h4 text-gray-900 mb-4">Register</h1>
                  </div>
                  <form @submit.prevent="signup()">
                    <div class="form-group">
                      <label>name </label>
                      <input type="text" class="form-control" v-model="form.name" id="exampleInputFirstName" placeholder="Enter  Name">
                    </div>
                 
                    <div class="form-group">
                      <label>Email</label>
                      <input type="email" class="form-control" v-model="form.email" id="exampleInputEmail" aria-describedby="emailHelp"
                        placeholder="Enter Email Address">
                    </div>
                    <div class="form-group">
                      <label>Password</label>
                      <input type="password" class="form-control" v-model="form.password" id="exampleInputPassword" placeholder="Password">
                    </div>
               
                    <div class="form-group">
                      <button type="submit" class="btn btn-primary btn-block">Register</button>
                    </div>
                    <hr>
                   
                  </form>
                  <hr>
                  <div class="text-center">
                    
                      <router-link to="/" class="font-weight-bold small">Already have an account?</router-link>
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
                email:null,
                password:null
            }
        }
       },
       methods:{
        signup(){
        //   this.$store.dispatch("auth/login")
 axios.post("/api/signup",this.form)
 .then((res) => 
  {
    // this.$store.commit("auth/login_success", {
    //                 token: res.access_token,
    //               //  remember: this.remember
    //             })
     //this.$store.dispatch('auth/fetchUser')
                this.$router.push({name: 'login'})
    console.log(res.data)

  })
 .catch((res) => {
//this.$store.commit("auth/login_failed", error.response.data)
  console.log(res)})
        }
       }
    }
</script>
</script>
