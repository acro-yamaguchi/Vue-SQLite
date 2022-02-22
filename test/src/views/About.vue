<template>
  <div class="about">
    <v-card v-for="n in data_from_php.length" :key="n">
      <v-card-title>{{ data_from_php[n - 1].title }}</v-card-title>
      <v-card-content>内容</v-card-content>
    </v-card>
  </div>
</template>

<script>
import axios from 'axios'
export default {
  data() {
    return {
      data_from_php: ''
    }
  },
  created() {
    axios.get('/Vue-SQLite/test/dist/api/test.php').then((response) => {
      this.data_from_php = response.data
      console.log(this.data_from_php)
    })
  }
}
</script>