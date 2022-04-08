<template>
    <div class="releasedNews pa-3">
        <v-container>
            <v-row justify="center">
                <v-card max-width="800px">
                    <v-toolbar color="#b5e61d">おしらせ公開</v-toolbar>

                    <v-card-text>
                        <v-row justify="center" class="ma-0">
                            <v-col cols="3" class="text-center cell_top remove_border-right">1番目</v-col>
                            <v-col cols="5" class="cell_top remove_border-right">
                                <v-text-field
                                    outlined
                                    dense
                                    hide-details
                                    clearable
                                    v-model="order1"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="4" class="cell_top">
                                <v-btn block tile color="success" @click="submit(1, order1)">登録</v-btn>
                            </v-col>
                        </v-row>
                        <v-row justify="center" class="ma-0">
                            <v-col cols="3" class="text-center cell remove_border-right">2番目</v-col>
                            <v-col cols="5" class="cell remove_border-right">
                                <v-text-field
                                    outlined
                                    dense
                                    hide-details
                                    clearable
                                    v-model="order2"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="4" class="cell">
                                <v-btn block tile color="success" @click="submit(2, order2)">登録</v-btn>
                            </v-col>
                        </v-row>
                        <v-row justify="center" class="ma-0">
                            <v-col cols="3" class="text-center cell remove_border-right">3番目</v-col>
                            <v-col cols="5" class="cell remove_border-right">
                                <v-text-field
                                    outlined
                                    dense
                                    hide-details
                                    clearable
                                    v-model="order3"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="4" class="cell">
                                <v-btn block tile color="success" @click="submit(3, order3)">登録</v-btn>
                            </v-col>
                        </v-row>
                        <v-row justify="center" class="ma-0">
                            <v-col cols="3" class="text-center cell remove_border-right">4番目</v-col>
                            <v-col cols="5" class="cell remove_border-right">
                                <v-text-field
                                    outlined
                                    dense
                                    hide-details
                                    clearable
                                    v-model="order4"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="4" class="cell">
                                <v-btn block tile color="success" @click="submit(4, order4)">登録</v-btn>
                            </v-col>
                        </v-row>
                        <v-row justify="center" class="ma-0">
                            <v-col cols="3" class="text-center cell remove_border-right">5番目</v-col>
                            <v-col cols="5" class="cell remove_border-right">
                                <v-text-field
                                    outlined
                                    dense
                                    hide-details
                                    clearable
                                    v-model="order5"
                                ></v-text-field>
                            </v-col>
                            <v-col cols="4" class="cell">
                                <v-btn block tile color="success" @click="submit(5, order5)">登録</v-btn>
                            </v-col>
                        </v-row>
                    </v-card-text>
                </v-card>
            </v-row>
        </v-container>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            news: [],
            newsInfo: {
                1: null,
                2: null,
                3: null,
                4: null,
                5: null
            },
            order1: '' 
        }
    },
    created() {
        axios.get('./api/getNews.php').then((response) => {
            this.news = response.data
            for(let i = 0; i < this.news.length; i++){
                this.newsInfo[this.news[i].publish_order] = this.news[i].id
            }
            if(this.newsInfo[1] !== null){
                this.order1 = this.newsInfo[1].toString()
            }
            if(this.newsInfo[2] !== null){
                this.order2 = this.newsInfo[2].toString()
            }
            if(this.newsInfo[3] !== null){
                this.order3 = this.newsInfo[3].toString()
            }
            if(this.newsInfo[4] !== null){
                this.order4 = this.newsInfo[4].toString()
            }
            if(this.newsInfo[5] !== null){
                this.order5 = this.newsInfo[5].toString()
            }
            
        })
    },
    methods: {
        submit(order, id){
            let data = {order: order, id: id}
            axios.post('./api/setOrder.php', data)
        }
    }
}
</script>

<style scoped>
.cell {
  border: solid;
  border-top: none;
  border-color: rgba(0, 0, 0, 0.8);
}

.cell_top {
  border: solid;
  border-color: rgba(0, 0, 0, 0.8);
}

.remove_border-right {
  border-right: none;
}
</style>