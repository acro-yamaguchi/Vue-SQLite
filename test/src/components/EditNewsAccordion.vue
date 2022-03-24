<template>
    <v-expansion-panels>
        <v-expansion-panel>
            <v-expansion-panel-header color="#b5e61d">
                お知らせ編集
            </v-expansion-panel-header>
            <v-expansion-panel-content>
                <v-container class="mt-5">
                    <v-row justify='center'>
                        <v-col cols="12">
                            <v-row>
                                <v-col cols="1" class="text-body-1 text-center cell_top remove_border-right">
                                    No.
                                </v-col>
                                <v-col cols="4" class="text-body-1 text-center cell_top remove_border-right">
                                    見出し
                                </v-col>
                                <v-col cols="4" class="text-body-1 text-center cell_top remove_border-right">
                                    概要
                                </v-col>
                                <v-col cols="1" class="text-body-1 text-center cell_top remove_border-right">
                                    公開中
                                </v-col>
                                <v-col cols="2" class="text-body-1 text-center cell_top">
                                    編集
                                </v-col>
                            </v-row>

                            <!-- news -->
                            <v-row v-for="item in news" :key="item">
                                <v-col cols="1" class="text-body-1 text-center cell_top remove_border-right">
                                    {{ item.id }}
                                </v-col>
                                <v-col cols="4" class="text-body-1 text-center cell_top remove_border-right">
                                    {{ item.title }}
                                </v-col>
                                <v-col cols="4" class="text-body-1 text-center cell_top remove_border-right">
                                    {{ item.summary }}
                                </v-col>
                                <v-col cols="1" class="text-body-1 text-center cell_top remove_border-right">
                                    ✅
                                </v-col>
                                <v-col cols="1" class="text-body-1 text-center cell_top">
                                    <v-btn
                                    color="success"
                                    block
                                    >編集</v-btn>
                                </v-col>
                            </v-row>
                        </v-col>
                    </v-row>
                </v-container>
            </v-expansion-panel-content>
        </v-expansion-panel>
    </v-expansion-panels>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            news: []
        }
    },
    created() {
        axios.get('./api/getNews.php').then((response) => {
            this.news = response.data
        })
    }
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

.remove_border-right {
  border-right: none;
}
</style>