<template>
  <div class="about">
    <h1>{{ data_from_php.message }} {{ data_from_php.name }}!</h1>
    <h2>{{ data_from_php.date }}</h2>
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
    axios.get('/Vue-SQLite/test/dist//api/test.php').then((response) => {
      this.data_from_php = response.data
    })
  }
}
</script>