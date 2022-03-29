<template>
    <div class="releasedNews">
        <v-card max-width="800px">
            <v-toolbar color="#b5e61d">おしらせ公開</v-toolbar>

            <v-card-text>
                
            </v-card-text>
        </v-card>
    </div>
</template>

<script>
import axios from 'axios'
export default {
    data() {
        return {
            news: [],
            headers: [
                {
                    text: 'No',
                    sortable: false,
                    value: 'no',
                    divider: true,
                    align: 'center'
                },
                { text: 'id', sortable: false, value: 'id', divider: true, align: 'center' },
                { text: '登録', sortable: false, value: 'actions', divider: true, align: 'center' },
            ],
        }
    },
    created() {
        axios.get('./api/getNews.php').then((response) => {
            this.news = response.data
            for(let i = 0; i < this.news.length; i++){
                this.news[i].order = Boolean(this.news[i].order) 
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