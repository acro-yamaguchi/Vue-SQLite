<template>
  <div class="about">
    <v-container fluid>
      <v-row justify="center" class="mt-5">
        <v-col cols="12" class="text-h5 text-center">【会社概要】</v-col>
        <v-col cols="12" md="8" class="mb-6">
          <v-row>
            <v-col cols="5" class="text-body-1 text-center cell_top cell_left">
              会社名
            </v-col>
            <v-col cols="7" class="text-body-1 text-center cell_top">
              株式会社Happy Position
            </v-col>
            <v-col cols="5" class="text-body-1 text-center cell cell_left">
              設 立
            </v-col>
            <v-col cols="7" class="text-body-1 text-center cell">
              2022年2月22日
            </v-col>
            <v-col cols="5" class="text-body-1 text-center cell cell_left">
              資本金
            </v-col>
            <v-col cols="7" class="text-body-1 text-center cell">
              2,000,000円
            </v-col>
            <v-col cols="5" class="text-body-1 text-center cell cell_left">
              代 表
            </v-col>
            <v-col cols="7" class="text-body-1 text-center cell">
              代表取締役 神田幸志郎
            </v-col>
            <v-col cols="5" class="text-body-1 text-center cell cell_left">
              本 社
            </v-col>
            <v-col cols="7" class="text-body-1 text-center cell">
              これから追加
            </v-col>
            <v-col cols="5" class="text-body-1 text-center cell cell_left">
              主要取引銀行
            </v-col>
            <v-col cols="7" class="text-body-1 text-center cell">
              これから追加
            </v-col>
            <v-col cols="5" class="text-body-1 text-center cell cell_left">
              業務内容
            </v-col>
            <v-col cols="7" class="text-body-1 text-center cell">
              これから追加
            </v-col>
          </v-row>
        </v-col>
      </v-row>
    </v-container>
  </div>
</template>

<script>
export default {
  data() {
    return {
    }
  },
}
</script>

<style scoped>
.cell {
  border: solid;
  border-top: none;
}

.cell_top {
  border: solid;
}

.cell_left {
  border-right: none;
}
</style>