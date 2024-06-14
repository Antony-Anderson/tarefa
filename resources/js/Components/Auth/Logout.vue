<template>
	<div>
		<button class="btn btn-primary" @click="logout()">Logout</button>
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