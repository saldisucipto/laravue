<template>
  <div class="container pt-5">
    <div class="row justify-content-center" v-if="$gate.isAdmin()">
      <div class="col-md-12">
        <passport-clients></passport-clients>
        <passport-authorized-clients></passport-authorized-clients>
        <passport-personal-access-tokens></passport-personal-access-tokens>
      </div>
    </div>
    <div class="row justify-content-center" v-if="$gate.isUser()">
      <div class="col-md-12">
        <not-found></not-found>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  name: "Developer",
  mounted() {
    console.log("Component mounted.");
  },
};
</script>
