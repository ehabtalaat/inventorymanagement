<template>
	
</template>
<script type="text/javascript">
	import Swal from 'sweetalert2'
export default {
   created(){
    this.$store.dispatch("auth/logout")
   Swal.fire(
  'logout successfully',
  'success'
)
    this.$router.push({ name: 'login'})
   }
 
}
</script>
