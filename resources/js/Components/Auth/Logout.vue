<template>
	<div>
		<a class="dropdown-item" @click="logout()">Sair</a> 
	</div>
</template>

<script>
export default {	
  methods: {
    logout() {
      	axios.post("api/logout").then((response) => {
			localStorage.removeItem("token");
			window.location.href = window.location.origin + "/login";
		})
		.catch((error) => {
			this.$auth.userNotAllowed(error);
		});
    },
  },
};
</script>