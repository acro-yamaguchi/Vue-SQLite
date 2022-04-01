<template>
    <v-expansion-panels>
        <v-expansion-panel>
            <v-expansion-panel-header color="#b5e61d">
                お知らせ編集
            </v-expansion-panel-header>
            <v-expansion-panel-content class="px-0 py-3">
                <v-container class="mt-5 pa-0">
                    <v-row justify='center'>
                       <v-data-table
                        :headers='headers'
                        :items='news'
                        hide-default-footer
                        :items-per-page='-1'
                        style="border: thin solid rgba(0, 0, 0, .12);"
                        >
                            <template v-slot:[`item.actions`]="{ item }">
                                <v-btn color='primary' @click="editItem(item)">編集</v-btn>
                            </template>
                            <template v-slot:[`item.is_published`]="{ item }">
                                <v-simple-checkbox
                                 v-model="item.publish_order"
                                 disabled
                                ></v-simple-checkbox>
                            </template>
                        </v-data-table>
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
            news: [],
            headers: [
                {
                    text: 'ID',
                    sortable: true,
                    value: 'id',
                    width: '15%',
                    divider: true
                },
                { text: '見出し', sortable: false, value: 'title', width: '30%', divider: true },
                { text: '概要', sortable: false, value: 'summary', width: '30%', divider: true },
                { text: '公開中', sortable: true, value: 'is_published', width: '15%', divider: true, align: 'center' },
                { text: '編集', sortable: false, value: 'actions', width: '10%', divider: true, align: 'center' },
            ],
        }
    },
    created() {
        axios.get('./api/getAllNews.php').then((response) => {
            this.news = response.data
            for(let i = 0; i < this.news.length; i++){
                this.news[i].publish_order = Boolean(this.news[i].publish_order) 
            }
        })
    },
    methods: {
        editItem(item){
            console.log(item)
        }
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