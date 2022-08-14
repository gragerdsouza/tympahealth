<template>
  <v-app>
  <v-app-bar app dark>
    <!-- -->
      <div class="d-flex align-center mr-2">
         <img alt="Vue logo" src="./assets/logo.svg"/>
      </div>
      <v-spacer></v-spacer>
  </v-app-bar>

  <!-- Sizes your content based upon application components -->
  <v-main>
    <!-- Provides the application the proper gutter -->
    <v-container fluid>
      <!-- If using vue-router -->
      <router-view></router-view>
    </v-container>
  </v-main>

  <v-footer app dark>
    <!-- -->
    <div class="d-flex align-center mr-2">
         <img alt="Vue logo" src="./assets/logo.svg"/>
      </div>
  </v-footer>
</v-app>
</template>
<script>
  export default {
    name: "app",
  };
</script>